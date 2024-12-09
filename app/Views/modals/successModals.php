<?php if ($addStudentSuccess): ?>
    <div class="modal fade" id="addStudentSuccessModal" tabindex="-1" aria-labelledby="addStudentSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success text-white">
                <div class="modal-body text-center">
                    <p id="alertMessage" class="mb-0">Student Added Successfully</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($deleteStudentSuccess): ?>
    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success text-white">
                <div class="modal-body text-center">
                    <p id="alertMessage" class="mb-0">Student Deleted Successfully</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($editSuccess): ?>
    <div class="modal fade" id="editStudentSuccessModal" tabindex="-1" aria-labelledby="editStudentSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success text-white">
                <div class="modal-body text-center">
                    <p id="alertMessage" class="mb-0">Student Updated Successfully</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- Course Success Modals -->
<?php if (isset($_SESSION['add_course_success'])): ?>
    <div class="modal fade" id="addCourseSuccessModal" tabindex="-1" aria-labelledby="addCourseSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success text-white">
                <div class="modal-body text-center">
                    <p id="alertMessage" class="mb-0">Course Added Successfully</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['delete_course_success'])): ?>
    <div class="modal fade" id="deleteCourseSuccessModal" tabindex="-1" aria-labelledby="deleteCourseSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success text-white">
                <div class="modal-body text-center">
                    <p id="alertMessage" class="mb-0">Course Deleted Successfully</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['edit_course_success'])): ?>
    <div class="modal fade" id="editCourseSuccessModal" tabindex="-1" aria-labelledby="editCourseSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success text-white">
                <div class="modal-body text-center">
                    <p id="alertMessage" class="mb-0">Course Updated Successfully</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Trigger Add Success Modal
        <?php if ($addStudentSuccess): ?>
            const addStudentModal = new bootstrap.Modal(document.getElementById('addStudentSuccessModal'));
            addStudentModal.show();
            setTimeout(() => addStudentModal.hide(), 3000);
        <?php endif; ?>
        
        // Trigger Delete Success Modal
        <?php if ($deleteStudentSuccess): ?>
            const deleteSuccessModal = new bootstrap.Modal(document.getElementById('deleteSuccessModal'));
            deleteSuccessModal.show();
            setTimeout(() => deleteSuccessModal.hide(), 3000);
        <?php endif; ?>
        
        // Trigger Edit Success Modal
        <?php if ($editSuccess): ?>
            const editSuccessModal = new bootstrap.Modal(document.getElementById('editStudentSuccessModal'));
            editSuccessModal.show();
            setTimeout(() => editSuccessModal.hide(), 3000);
        <?php endif; ?>
        
        // Course Success Modals
        <?php if (isset($_SESSION['add_course_success'])): ?>
            const addCourseModal = new bootstrap.Modal(document.getElementById('addCourseSuccessModal'));
            addCourseModal.show();
            setTimeout(() => addCourseModal.hide(), 3000);
            <?php unset($_SESSION['add_course_success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['delete_course_success'])): ?>
            const deleteCourseModal = new bootstrap.Modal(document.getElementById('deleteCourseSuccessModal'));
            deleteCourseModal.show();
            setTimeout(() => deleteCourseModal.hide(), 3000);
            <?php unset($_SESSION['delete_course_success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['edit_course_success'])): ?>
            const editCourseModal = new bootstrap.Modal(document.getElementById('editCourseSuccessModal'));
            editCourseModal.show();
            setTimeout(() => editCourseModal.hide(), 3000);
            <?php unset($_SESSION['edit_course_success']); ?>
        <?php endif; ?>
    });
</script>