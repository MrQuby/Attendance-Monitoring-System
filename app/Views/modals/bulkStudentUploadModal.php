<div class="modal fade" id="bulkUploadModal" tabindex="-1" aria-labelledby="bulkUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkUploadModalLabel">Upload Student List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bulkUploadForm" enctype="multipart/form-data">
                    <div class="upload-instructions mb-3">
                        <p class="mb-2">Your CSV file should include the following information:</p>
                        <ul class="list-unstyled">
                            <li>• Student ID</li>
                            <li>• First Name</li>
                            <li>• Last Name</li>
                            <li>• Email Address</li>
                            <li>• Birth Date</li>
                            <li>• Phone Number</li>
                            <li>• Home Address</li>
                            <li>• Gender</li>
                            <li>• Guardian's Name</li>
                            <li>• Guardian's Contact Number</li>
                            <li>• Year Level</li>
                            <li>• Course</li>
                            <li>• RFID Number</li>
                        </ul>
                        <p class="text-muted small">Download the template for the correct format. Make sure all required information is filled out.</p>
                    </div>
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Choose CSV or Excel File</label>
                        <input type="file" class="form-control" id="fileUpload" name="file" accept=".csv,.xlsx,.xls" required>
                    </div>
                    <div id="uploadStatus" class="alert d-none"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="uploadSubmit">Upload</button>
            </div>
        </div>
    </div>
</div>
