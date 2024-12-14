document.addEventListener("DOMContentLoaded", function () {
    // Handle real-time student search
    const searchInput = document.getElementById('student_search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const studentTable = document.querySelector('.student-list table tbody');
            const rows = studentTable.getElementsByTagName('tr');

            for (let row of rows) {
                // Skip if it's the "No students found" row
                if (row.cells.length === 1 && row.cells[0].hasAttribute('colspan')) {
                    continue;
                }

                const id = row.cells[0]?.textContent.toLowerCase() || '';
                const name = row.cells[1]?.querySelector('span')?.textContent.toLowerCase() || '';
                const email = row.cells[2]?.textContent.toLowerCase() || '';
                const yearLevel = row.cells[3]?.textContent.toLowerCase() || '';
                const course = row.cells[4]?.textContent.toLowerCase() || '';

                if (id.includes(searchTerm) || 
                    name.includes(searchTerm) || 
                    email.includes(searchTerm) || 
                    yearLevel.includes(searchTerm) ||
                    course.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }

            // Show "No results found" message if no matches
            const visibleRows = Array.from(rows).filter(row => 
                row.style.display !== 'none' && 
                !(row.cells.length === 1 && row.cells[0].hasAttribute('colspan'))
            );

            const noResultsRow = studentTable.querySelector('.no-results');
            if (visibleRows.length === 0) {
                if (!noResultsRow) {
                    const newRow = document.createElement('tr');
                    newRow.className = 'no-results';
                    newRow.innerHTML = '<td colspan="6" class="text-center" style="padding: 20px 0;">No matching students found.</td>';
                    studentTable.appendChild(newRow);
                }
            } else if (noResultsRow) {
                noResultsRow.remove();
            }
        });
    }

    // Real-time search for teachers
    document.getElementById('teacher_search')?.addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('.teacher-list tbody tr');
        let hasVisibleRows = false;

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "No teachers found" message if no matching results
        const noTeachersRow = document.querySelector('.teacher-list .no-teachers-message');
        if (!hasVisibleRows) {
            if (!noTeachersRow) {
                const tbody = document.querySelector('.teacher-list tbody');
                const newRow = document.createElement('tr');
                newRow.className = 'no-teachers-message';
                newRow.innerHTML = '<td colspan="6" class="text-center" style="padding: 20px 0;">No teachers found.</td>';
                tbody.appendChild(newRow);
            } else {
                noTeachersRow.style.display = '';
            }
        } else if (noTeachersRow) {
            noTeachersRow.style.display = 'none';
        }
    });

    // Real-time search for attendance
    document.getElementById('attendance_search')?.addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('.attendance tbody tr');
        let hasVisibleRows = false;

        tableRows.forEach(row => {
            const id = row.cells[0]?.textContent.toLowerCase() || '';
            const name = row.cells[1]?.querySelector('span')?.textContent.toLowerCase() || '';
            const yearLevel = row.cells[2]?.textContent.toLowerCase() || '';
            const course = row.cells[3]?.textContent.toLowerCase() || '';

            if (id.includes(searchValue) || 
                name.includes(searchValue) || 
                yearLevel.includes(searchValue) || 
                course.includes(searchValue)) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "No attendance records found" message if no matching results
        const noRecordsRow = document.querySelector('.attendance .no-records-message');
        if (!hasVisibleRows) {
            if (!noRecordsRow) {
                const tbody = document.querySelector('.attendance tbody');
                const newRow = document.createElement('tr');
                newRow.className = 'no-records-message';
                newRow.innerHTML = '<td colspan="7" class="text-center" style="padding: 20px 0;">No attendance records found.</td>';
                tbody.appendChild(newRow);
            } else {
                noRecordsRow.style.display = '';
            }
        } else if (noRecordsRow) {
            noRecordsRow.style.display = 'none';
        }
    });

    // Date filter for attendance
    document.getElementById('filter_date')?.addEventListener('change', function(e) {
        const dateValue = e.target.value;
        const tableRows = document.querySelectorAll('.attendance tbody tr');
        let hasVisibleRows = false;

        tableRows.forEach(row => {
            const fullDate = row.cells[4]?.textContent.trim() || ''; // e.g., "December 07, 2024"
            // Convert the date to the same format as dateValue (YYYY-MM-DD)
            const parts = fullDate.match(/(\w+) (\d+), (\d+)/);
            if (parts) {
                const month = new Date(Date.parse(parts[1] + " 1, 2000")).getMonth() + 1; // Get month number (1-12)
                const day = parseInt(parts[2]);
                const year = parts[3];
                // Format as YYYY-MM-DD
                const rowDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                
                if (rowDate === dateValue) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            } else {
                row.style.display = 'none';
            }
        });

        // Show "No attendance records found" message if no matching results
        const noRecordsRow = document.querySelector('.attendance .no-records-message');
        if (!hasVisibleRows) {
            if (!noRecordsRow) {
                const tbody = document.querySelector('.attendance tbody');
                const newRow = document.createElement('tr');
                newRow.className = 'no-records-message';
                newRow.innerHTML = '<td colspan="7" class="text-center" style="padding: 20px 0;">No attendance records found for selected date.</td>';
                tbody.appendChild(newRow);
            } else {
                noRecordsRow.style.display = '';
            }
        } else if (noRecordsRow) {
            noRecordsRow.style.display = 'none';
        }
    });

    // Function to filter logs
    function filterLogs() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        fetch('../api/getLogs.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                startDate: startDate,
                endDate: endDate
            })
        })
        .then(response => response.json())
        .then(data => {
            const logsTableBody = document.getElementById('logsTableBody');
            logsTableBody.innerHTML = '';

            data.forEach(log => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${log.user_id}</td>
                    <td>${log.user_type.charAt(0).toUpperCase() + log.user_type.slice(1)}</td>
                    <td>${log.action.charAt(0).toUpperCase() + log.action.slice(1)}</td>
                    <td>${log.ip_address}</td>
                    <td>${log.browser_info}</td>
                    <td>${log.timestamp}</td>
                `;
                logsTableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
    }

    // Add event listeners for date inputs
    document.getElementById('startDate')?.addEventListener('change', filterLogs);
    document.getElementById('endDate')?.addEventListener('change', filterLogs);

    // Add event listener for search input in logs
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('#logsTableBody tr');
        let hasVisibleRows = false;

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "No logs found" message if no matching results
        if (!hasVisibleRows) {
            const tbody = document.getElementById('logsTableBody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center">No matching logs found</td></tr>';
        }
    });

    // Function to reset log filters
    window.resetFilters = function() {
        document.getElementById('searchInput').value = '';
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';
        
        // Remove any date constraints
        document.getElementById('endDate').removeAttribute('min');
        
        // Trigger the filter to refresh the table
        filterLogs();
    }

    // Add event listener for reset button in attendance section
    document.getElementById('resetAttendanceButton')?.addEventListener('click', function() {
        // Reset search input
        const searchInput = document.getElementById('attendance_search');
        if (searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
        }

        // Reset date filter
        const dateFilter = document.getElementById('filter_date');
        if (dateFilter) {
            dateFilter.value = '';
            dateFilter.dispatchEvent(new Event('change'));
        }

        // Show all rows
        const tableRows = document.querySelectorAll('.attendance tbody tr');
        tableRows.forEach(row => {
            if (!row.classList.contains('no-records-message')) {
                row.style.display = '';
            }
        });

        // Remove any "no records found" message
        const noRecordsRow = document.querySelector('.attendance .no-records-message');
        if (noRecordsRow) {
            noRecordsRow.remove();
        }
    });
});
