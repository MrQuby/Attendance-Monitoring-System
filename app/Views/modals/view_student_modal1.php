<!-- Modal for Viewing Student Details -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title w-100 text-center" id="viewStudentModalLabel"><i class="fas fa-eye me-2"></i>View Student</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4 text-center">
                    <img id="view-profile-picture-display" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                
                <!-- Student Info Display (Read-Only Fields) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view-student-id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="view-student-id" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="view-first-name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="view-first-name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="view-last-name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="view-last-name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="view-student-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="view-student-email" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view-student-birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control" id="view-student-birthdate" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="view-student-phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="view-student-phone" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="view-student-gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="view-student-gender" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view-student-level" class="form-label">Year Level</label>
                            <input type="text" class="form-control" id="view-student-level" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="view-course" class="form-label">Course</label>
                            <input type="text" class="form-control" id="view-course" readonly>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="view-student-address" class="form-label">Address</label>
                    <textarea class="form-control" id="view-student-address" rows="2" readonly></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
