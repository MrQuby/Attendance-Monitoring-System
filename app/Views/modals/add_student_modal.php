<!-- Modal for Adding Student with Profile Picture Preview -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title w-100 text-center" id="addStudentModalLabel"><i class="fas fa-user-plus me-2"></i>Add Student</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-student-form" action="/app/Views/components/add_student.php" method="POST" enctype="multipart/form-data">
                    
                    <!-- Profile Picture Upload with Preview -->
                    <div class="mb-4 text-center">
                        <img id="addProfilePictureDisplay" src="../../../uploads/default-image.jpg" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mt-2">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewAddImage(event)">
                        </div>
                    </div>

                    <!-- Two-Column Layout for Fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- First Column Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                <input type="text" class="form-control" placeholder="Student ID" id="student_id" name="student_id" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="First Name" id="first_name" name="student_firstname" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Last Name" id="last_name" name="student_lastname" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email" id="student_email" name="student_email" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Second Column Fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="student_birthdate" name="student_birthdate" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" placeholder="Phone" id="student_phone" name="student_phone" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                <select class="form-select" id="student_gender" name="student_gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <!-- Year Level Field positioned below Gender -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                <select class="form-select" id="level" name="student_level" required>
                                    <option value="" disabled selected>Select Year Level</option>
                                    <option value="1st year">1st Year</option>
                                    <option value="2nd year">2nd Year</option>
                                    <option value="3rd year">3rd Year</option>
                                    <option value="4th year">4th Year</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Guardian Details Fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                <input type="text" class="form-control" placeholder="Guardian Name" id="guardian_name" name="guardian_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                                <input type="tel" class="form-control" placeholder="Guardian Contact" id="guardian_contact" name="guardian_contact" required>
                            </div>
                        </div>
                    </div>

                    <!-- Full-width Course Field -->
                    <div class="mb-4 input-group">
                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                        <select id="course_id" name="course_id" class="form-select" required>
                            <option value="" disabled selected>Select a Course</option>
                            <?php
                            $courses = $studentModel->getAllCourses();
                            foreach ($courses as $course) {
                                echo "<option value='{$course['course_id']}'>{$course['course_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Full-width Address Field -->
                    <div class="mb-4 input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <textarea class="form-control" placeholder="Address" id="student_address" name="student_address" required></textarea>
                    </div>

                    <!-- Center the Save button -->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to preview the selected image in the Add Student Modal
    function previewAddImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById("addProfilePictureDisplay");

        reader.onload = function() {
            if (reader.readyState === 2) {
                imageField.src = reader.result;  // Display the selected image
            }
        };

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
