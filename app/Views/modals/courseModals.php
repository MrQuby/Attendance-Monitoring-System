<?php
// Add Course Modal
?>
<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCourseForm" action="../../app/Controllers/courseController.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="courseId" class="form-label">Course ID</label>
                        <input type="text" class="form-control" id="courseId" name="course_id" required>
                        <div id="courseIdError" class="invalid-feedback" style="display: none;">
                            Course ID is required
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="courseName" name="course_name" required>
                        <div class="invalid-feedback">
                            Course Name is required
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="courseDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="courseDescription" name="course_description" required></textarea>
                        <div class="invalid-feedback">
                            Description is required
                        </div>
                    </div>
                    <?php if (isset($_SESSION['course_error'])): ?>
                        <div class="alert alert-danger mt-2">
                            <?php 
                                echo htmlspecialchars($_SESSION['course_error']); 
                                unset($_SESSION['course_error']);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCourseForm" action="../../app/Controllers/courseController.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="course_id" id="editCourseId">
                    <div class="mb-3">
                        <label for="editCourseName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="editCourseName" name="course_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCourseDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editCourseDescription" name="course_description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Course Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCourseModalLabel">Delete Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteCourseForm" action="../../app/Controllers/courseController.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="course_id" id="deleteCourseId">
                    <p>Are you sure you want to delete this course? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['show_add_course_modal'])): ?>
            // Show the modal
            const addCourseModal = new bootstrap.Modal(document.getElementById('addCourseModal'));
            addCourseModal.show();
            
            // Fill in the form data
            <?php if (isset($_SESSION['form_data'])): ?>
                document.getElementById('courseId').value = '<?php echo htmlspecialchars($_SESSION['form_data']['course_id']); ?>';
                document.getElementById('courseName').value = '<?php echo htmlspecialchars($_SESSION['form_data']['course_name']); ?>';
                document.getElementById('courseDescription').value = '<?php echo htmlspecialchars($_SESSION['form_data']['course_description']); ?>';
                <?php 
                    unset($_SESSION['form_data']);
                    unset($_SESSION['show_add_course_modal']);
                ?>
            <?php endif; ?>
        <?php endif; ?>
    });
</script>
