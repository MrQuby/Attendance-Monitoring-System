<div class="modal fade" id="bulkUploadModal" tabindex="-1" aria-labelledby="bulkUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkUploadModalLabel">Bulk Upload Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bulkUploadForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Choose CSV or Excel File</label>
                        <input type="file" class="form-control" id="fileUpload" name="file" accept=".csv,.xlsx,.xls" required>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted">File should contain the following columns:</p>
                        <ul class="text-muted">
                            <li>student_id</li>
                            <li>student_firstname</li>
                            <li>student_lastname</li>
                            <li>student_email</li>
                            <li>student_birthdate</li>
                            <li>student_phone</li>
                            <li>student_address</li>
                            <li>student_gender</li>
                            <li>guardian_name</li>
                            <li>guardian_contact</li>
                            <li>student_level</li>
                            <li>course_id</li>
                            <li>student_rfid</li>
                        </ul>
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
