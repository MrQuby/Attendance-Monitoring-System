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
            if (data.success) {
                statusDiv.className = 'alert alert-success';
                let message = data.message;
                if (data.errors && data.errors.length > 0) {
                    message += '\n\nWarnings:\n' + data.errors.join('\n');
                }
                statusDiv.textContent = message;
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                statusDiv.className = 'alert alert-danger';
                statusDiv.textContent = data.message;
                if (data.errors) {
                    statusDiv.textContent += '\n' + data.errors.join('\n');
                }
            }
        })
        .catch(error => {
            statusDiv.className = 'alert alert-danger';
            statusDiv.textContent = 'An error occurred during upload';
        });
});