<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title w-100 text-center" id="addStudentModalLabel"><i class="fas fa-user-plus me-2"></i>Add Student</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-student-form" action="/app/Views/components/addStudent.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_SESSION['add_student_error'])): ?>
                        <div class="alert alert-danger">
                            <?php 
                                echo htmlspecialchars($_SESSION['add_student_error']);
                                unset($_SESSION['add_student_error']);
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Profile Picture Upload with Preview -->
                    <div class="mb-4 text-center">
                        <img id="addProfilePictureDisplay" src="/../uploads/pp.png" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
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
                                <input type="text" class="form-control" placeholder="Student ID" id="student_id" name="student_id" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['student_id']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_id']) : ''; ?>" 
                                    required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                <input type="text" class="form-control" placeholder="Student RFID" id="student_rfid" name="student_rfid" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['student_rfid']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_rfid']) : ''; ?>" 
                                    required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="First Name" id="first_name" name="student_firstname" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['student_firstname']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_firstname']) : ''; ?>" 
                                    required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Last Name" id="last_name" name="student_lastname" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['student_lastname']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_lastname']) : ''; ?>" 
                                    required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email" id="student_email" name="student_email" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['student_email']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_email']) : ''; ?>" 
                                    required>
                            </div>
                            <!-- Course Field moved below Email -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                                <select id="course_id" name="course_id" class="form-select" required>
                                    <option value="" disabled selected>Select a Course</option>
                                    <?php
                                    $courses = $studentModel->getAllCourses();
                                    foreach ($courses as $course) {
                                        $selected = isset($_SESSION['add_student_form_data']['course_id']) && $_SESSION['add_student_form_data']['course_id'] == $course['course_id'] ? 'selected' : '';
                                        echo "<option value='{$course['course_id']}' {$selected}>{$course['course_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Second Column Fields including Guardian fields -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="student_birthdate" name="student_birthdate" max="" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['student_birthdate']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_birthdate']) : ''; ?>" 
                                    required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" placeholder="Phone" id="student_phone" name="student_phone" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['student_phone']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_phone']) : ''; ?>" 
                                    required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                <select class="form-select" id="student_gender" name="student_gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male" <?php echo isset($_SESSION['add_student_form_data']['student_gender']) && $_SESSION['add_student_form_data']['student_gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo isset($_SESSION['add_student_form_data']['student_gender']) && $_SESSION['add_student_form_data']['student_gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                            <!-- Year Level Field positioned below Gender -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                <select class="form-select" id="level" name="student_level" required>
                                    <option value="" disabled selected>Select Year Level</option>
                                    <option value="1st year" <?php echo isset($_SESSION['add_student_form_data']['student_level']) && $_SESSION['add_student_form_data']['student_level'] == '1st year' ? 'selected' : ''; ?>>1st Year</option>
                                    <option value="2nd year" <?php echo isset($_SESSION['add_student_form_data']['student_level']) && $_SESSION['add_student_form_data']['student_level'] == '2nd year' ? 'selected' : ''; ?>>2nd Year</option>
                                    <option value="3rd year" <?php echo isset($_SESSION['add_student_form_data']['student_level']) && $_SESSION['add_student_form_data']['student_level'] == '3rd year' ? 'selected' : ''; ?>>3rd Year</option>
                                    <option value="4th year" <?php echo isset($_SESSION['add_student_form_data']['student_level']) && $_SESSION['add_student_form_data']['student_level'] == '4th year' ? 'selected' : ''; ?>>4th Year</option>
                                </select>
                            </div>
                            <!-- Guardian Name and Guardian Contact Fields on the right side -->
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                <input type="text" class="form-control" placeholder="Guardian Name" id="guardian_name" name="guardian_name" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['guardian_name']) ? htmlspecialchars($_SESSION['add_student_form_data']['guardian_name']) : ''; ?>" 
                                    required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                                <input type="tel" class="form-control" placeholder="Guardian Contact" id="guardian_contact" name="guardian_contact" 
                                    value="<?php echo isset($_SESSION['add_student_form_data']['guardian_contact']) ? htmlspecialchars($_SESSION['add_student_form_data']['guardian_contact']) : ''; ?>" 
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Full-width Address Field -->
                    <div class="mb-4 input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <textarea class="form-control" placeholder="Address" id="student_address" name="student_address"><?php echo isset($_SESSION['add_student_form_data']['student_address']) ? htmlspecialchars($_SESSION['add_student_form_data']['student_address']) : ''; ?></textarea>
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

<?php
    // Clean up session data after displaying
    if (isset($_SESSION['add_student_form_data'])) {
        unset($_SESSION['add_student_form_data']);
    }
?>

<script>
    function previewAddImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById("addProfilePictureDisplay");

        reader.onload = function() {
            if (reader.readyState === 2) {
                imageField.src = reader.result;
            }
        };

        reader.readAsDataURL(event.target.files[0]);
    }

    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("student_birthdate").setAttribute("max", today);
    });
</script>
