// Handle Add Student Modal
document.addEventListener("DOMContentLoaded", function () {
    const addStudentModal = document.getElementById('addStudentModal');
    const addStudentForm = document.getElementById('add-student-form');

    if (addStudentModal) {
        const modal = new bootstrap.Modal(addStudentModal);

        addStudentModal.addEventListener('hide.bs.modal', function () {
            if (addStudentForm) {
                addStudentForm.reset();
            }
            const errorDiv = addStudentModal.querySelector('.alert-danger');
            if (errorDiv) {
                errorDiv.remove();
            }
        });

        if (addStudentModal.querySelector('.alert-danger')) {
            modal.show();
        }
    }
});

// Handle Edit Student Modal
document.querySelectorAll('.edit-student-btn').forEach(button => {
    button.addEventListener('click', function () {
        const studentId = this.getAttribute('data-id');

        fetch(`/app/Views/components/getStudent.php?student_id=${studentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const student = data.data;

                    document.getElementById('student-id').value = student.student_id || '';
                    document.getElementById('student-rfid').value = student.student_rfid || '';
                    document.getElementById('first-name').value = student.student_firstname || '';
                    document.getElementById('last-name').value = student.student_lastname || '';
                    document.getElementById('student-email').value = student.student_email || '';
                    document.getElementById('student-birthdate').value = student.student_birthdate || '';
                    document.getElementById('student-phone').value = student.student_phone || '';
                    document.getElementById('student-address').value = student.student_address || '';
                    document.getElementById('student-gender').value = student.student_gender || '';
                    document.getElementById('guardian-name').value = student.guardian_name || '';
                    document.getElementById('guardian-contact').value = student.guardian_contact || '';
                    document.getElementById('level').value = student.student_level || '';
                    document.getElementById('course').value = student.course_id || '';

                    document.getElementById('edit-profile-picture-display').src = student.profile_picture
                        ? `/${student.profile_picture}`
                        : '/uploads/pp.png';

                    const editModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
                    editModal.show();
                } else {
                    console.error('Error fetching student data:', data.message);
                }
            })
            .catch(error => console.error('AJAX error:', error));
    });
});

// Handle edit student form submission
document.getElementById('edit-student-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/app/Views/components/editStudent.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const errorDiv = document.querySelector('#edit-student-form .alert-danger');
        if (errorDiv) {
            errorDiv.remove();
        }

        if (!data.success) {
            // Show error message in modal
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.textContent = data.error;
            document.querySelector('#edit-student-form').insertBefore(alertDiv, document.querySelector('#edit-student-form').firstChild);
        } else {
            // Success - close modal and reload page
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editStudentModal'));
            editModal.hide();
            document.querySelector('.modal-backdrop').remove();
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Handle modal close
document.getElementById('editStudentModal').addEventListener('hidden.bs.modal', function () {
    // Remove modal backdrop
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
        backdrop.remove();
    }
    // Remove any error messages
    const errorDiv = document.querySelector('#edit-student-form .alert-danger');
    if (errorDiv) {
        errorDiv.remove();
    }
});

// Preview function for newly selected profile picture
function previewEditProfileImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('edit-profile-picture-display').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

// Handle View Student Modal
document.querySelectorAll('.view-student-btn').forEach(function (button) {
    button.addEventListener('click', function () {
        const studentId = this.getAttribute('data-id');
        fetch(`/app/Views/components/getStudent.php?student_id=${studentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const student = data.data;

                    document.getElementById('view-student-id').value = student.student_id || '';
                    document.getElementById('view-student-rfid').value = student.student_rfid || '';
                    document.getElementById('view-first-name').value = student.student_firstname || '';
                    document.getElementById('view-last-name').value = student.student_lastname || '';
                    document.getElementById('view-student-email').value = student.student_email || '';
                    document.getElementById('view-student-birthdate').value = student.student_birthdate || '';
                    document.getElementById('view-student-phone').value = student.student_phone || '';
                    document.getElementById('view-student-gender').value = student.student_gender || '';
                    document.getElementById('view-guardian-name').value = student.guardian_name || '';
                    document.getElementById('view-guardian-contact').value = student.guardian_contact || '';
                    document.getElementById('view-student-level').value = student.student_level || '';
                    document.getElementById('view-course').value = student.course_id || '';
                    document.getElementById('view-student-address').value = student.student_address || '';

                    document.getElementById('view-profile-picture-display').src = student.profile_picture
                        ? `/${student.profile_picture}`
                        : '/uploads/pp.png';
                } else {
                    console.error('Error fetching student data:', data.message);
                }
            })
            .catch(error => console.error('AJAX error:', error));
    });
});

// Handle Delete Student Modals
document.addEventListener("DOMContentLoaded", function () {
    let deleteForm;

    document.querySelectorAll(".delete-student-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            deleteForm = this.closest("form");
            const deleteModal = new bootstrap.Modal(document.getElementById("deleteConfirmationModal"));
            deleteModal.show();
        });
    });

    document.getElementById("confirmDeleteButton").addEventListener("click", function () {
        if (deleteForm) deleteForm.submit();

        const deleteModal = bootstrap.Modal.getInstance(document.getElementById("deleteConfirmationModal"));
        deleteModal.hide();

        const successModal = new bootstrap.Modal(document.getElementById("deleteSuccessModal"));
        successModal.show();

        setTimeout(() => {
            successModal.hide();
        }, 3000);
    });
});