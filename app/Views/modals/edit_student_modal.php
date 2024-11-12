<!-- Modal for Editing Student with Profile Picture Preview -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title w-100 text-center" id="editStudentModalLabel"><i class="fas fa-user-edit me-2"></i>Edit Student</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-student-form" action="/app/Views/components/edit_student.php" method="POST" enctype="multipart/form-data">
                    
                    <!-- Profile Picture Upload with Preview -->
                    <div class="mb-4 text-center">
                        <img id="edit-profile-picture-display" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mt-2">
                            <label for="edit-profile-picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="edit-profile-picture" name="profile_picture" accept="image/*" onchange="previewEditProfileImage(event)">
                        </div>
                    </div>

                    <!-- Two-Column Layout for Fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Student ID and RFID Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                <input type="text" class="form-control" placeholder="Student ID" id="student-id" name="student_id" readonly>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                <input type="text" class="form-control" placeholder="Student RFID" id="student-rfid" name="student_rfid" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="First Name" id="first-name" name="student_firstname" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Last Name" id="last-name" name="student_lastname" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email" id="student-email" name="student_email" required>
                            </div>
                            <!-- Course Field below Email -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                                <select id="course" name="course_id" class="form-select" required>
                                    <option value="" disabled>Select a Course</option>
                                    <?php
                                    $courses = $studentModel->getAllCourses();
                                    foreach ($courses as $course) {
                                        echo "<option value='{$course['course_id']}'>{$course['course_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Second Column Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="student-birthdate" name="student_birthdate" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" placeholder="Phone" id="student-phone" name="student_phone" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                <select class="form-select" id="student-gender" name="student_gender" required>
                                    <option value="" disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <!-- Year Level Field positioned below Gender -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                <select class="form-select" id="level" name="student_level" required>
                                    <option value="" disabled>Select Year Level</option>
                                    <option value="1st year">1st Year</option>
                                    <option value="2nd year">2nd Year</option>
                                    <option value="3rd year">3rd Year</option>
                                    <option value="4th year">4th Year</option>
                                </select>
                            </div>
                            <!-- Guardian Details Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                <input type="text" class="form-control" placeholder="Guardian Name" id="guardian-name" name="guardian_name">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                                <input type="tel" class="form-control" placeholder="Guardian Contact" id="guardian-contact" name="guardian_contact">
                            </div>
                        </div>
                    </div>

                    <!-- Full-width Address Field -->
                    <div class="mb-4 input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <textarea class="form-control" placeholder="Address" id="student-address" name="student_address"></textarea>
                    </div>

                    <!-- Save Changes Button -->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to preview the selected image in the Edit Student Modal
    function previewEditProfileImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById("edit-profile-picture-display");

        reader.onload = function() {
            if (reader.readyState === 2) {
                imageField.src = reader.result;
            }
        };

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
