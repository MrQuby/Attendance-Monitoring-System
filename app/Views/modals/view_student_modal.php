<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title w-100 text-center" id="viewStudentModalLabel"><i class="fas fa-user-edit me-2"></i>View Student</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Profile Picture Display -->
                    <div class="mb-4 text-center">
                        <img id="view-profile-picture-display" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <!-- Two-Column Layout for Fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Student ID and RFID Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                <input type="text" class="form-control" placeholder="Student ID" id="view-student-id" name="student_id" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                <input type="text" class="form-control" placeholder="Student RFID" id="view-student-rfid" name="student_rfid" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="First Name" id="view-first-name" name="student_firstname" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Last Name" id="view-last-name" name="student_lastname" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email" id="view-student-email" name="student_email" readonly>
                            </div>
                            <!-- Course Field below Email -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                                <input type="text" class="form-control" placeholder="Course" id="view-course" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Second Column Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="view-student-birthdate" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" placeholder="Phone" id="view-student-phone" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                <input type="text" class="form-control" placeholder="Gender" id="view-student-gender" readonly>
                            </div>
                            <!-- Year Level Field positioned below Gender -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                <input type="text" class="form-control" placeholder="Year Level" id="view-student-level" readonly>
                            </div>
                            <!-- Guardian Details Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                <input type="text" class="form-control" placeholder="Guardian Name" id="view-guardian-name" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                                <input type="tel" class="form-control" placeholder="Guardian Contact" id="view-guardian-contact" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Full-width Address Field -->
                    <div class="mb-4 input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <textarea class="form-control" placeholder="Address" id="view-student-address" readonly></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>