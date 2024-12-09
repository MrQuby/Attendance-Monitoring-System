$(document).ready(function() {
    // Add event listeners for real-time filtering
    $('#logTypeFilter, #filterDate, #searchInput').on('change keyup', function() {
        filterLogs();
    });
});

function resetFilters() {
    $('#logTypeFilter').val('all');
    $('#filterDate').val('');
    $('#searchInput').val('');
    filterLogs();
}

function filterLogs() {
    const userType = $('#logTypeFilter').val();
    const filterDate = $('#filterDate').val();
    const searchQuery = $('#searchInput').val().toLowerCase();

    // Show loading state
    const tbody = $('#logsTableBody');
    tbody.html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');

    // Prepare the data to send
    const data = {
        userType: userType,
        filterDate: filterDate,
        searchQuery: searchQuery
    };

    // Make the API call
    $.ajax({
        url: '../../api/getLogs.php',
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(logs) {
            // Clear the loading message
            tbody.empty();

            if (logs.length === 0) {
                tbody.html('<tr><td colspan="6" class="text-center">No logs found</td></tr>');
                return;
            }

            // Filter logs based on search query client-side
            const filteredLogs = logs.filter(log => {
                if (!searchQuery) return true;
                return (
                    (log.user_id && log.user_id.toLowerCase().includes(searchQuery)) ||
                    (log.user_type && log.user_type.toLowerCase().includes(searchQuery)) ||
                    (log.action && log.action.toLowerCase().includes(searchQuery)) ||
                    (log.ip_address && log.ip_address.toLowerCase().includes(searchQuery)) ||
                    (log.browser_info && log.browser_info.toLowerCase().includes(searchQuery)) ||
                    (log.timestamp && log.timestamp.toLowerCase().includes(searchQuery))
                );
            });

            if (filteredLogs.length === 0) {
                tbody.html('<tr><td colspan="6" class="text-center">No matching logs found</td></tr>');
                return;
            }

            // Add the filtered logs to the table
            filteredLogs.forEach(function(log) {
                const row = $('<tr>').html(`
                    <td>${log.user_id || ''}</td>
                    <td>${log.user_type ? (log.user_type.charAt(0).toUpperCase() + log.user_type.slice(1)) : ''}</td>
                    <td>${log.action ? (log.action.charAt(0).toUpperCase() + log.action.slice(1)) : ''}</td>
                    <td>${log.ip_address || ''}</td>
                    <td>${log.browser_info || ''}</td>
                    <td>${log.timestamp || ''}</td>
                `);
                tbody.append(row);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            tbody.html('<tr><td colspan="6" class="text-center text-danger">Error loading logs</td></tr>');
        }
    });
}
