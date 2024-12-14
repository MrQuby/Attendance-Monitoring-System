// Clear status when modal is closed
document.getElementById('bulkUploadModal').addEventListener('hidden.bs.modal', function () {
    const statusDiv = document.getElementById('uploadStatus');
    statusDiv.textContent = '';
    statusDiv.className = '';
    document.getElementById('bulkUploadForm').reset();
});

// Clear status when new file is selected
document.getElementById('fileUpload').addEventListener('change', function() {
    const statusDiv = document.getElementById('uploadStatus');
    statusDiv.textContent = '';
    statusDiv.className = '';
});

document.getElementById('uploadSubmit').addEventListener('click', function () {
    const form = document.getElementById('bulkUploadForm');
    const fileInput = document.getElementById('fileUpload');
    const statusDiv = document.getElementById('uploadStatus');

    if (!fileInput.files[0]) {
        statusDiv.textContent = 'Please select a file';
        statusDiv.className = 'alert alert-danger';
        return;
    }

    const formData = new FormData(form);

    statusDiv.textContent = 'Uploading...';
    statusDiv.className = 'alert alert-info';

    fetch('../../app/Views/components/processUpload.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            statusDiv.textContent = data.message;
            if (data.success) {
                statusDiv.className = 'alert alert-success';
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                statusDiv.className = 'alert alert-warning';
            }
        })
        .catch(error => {
            statusDiv.className = 'alert alert-danger';
            statusDiv.textContent = 'An error occurred during upload';
        });
});