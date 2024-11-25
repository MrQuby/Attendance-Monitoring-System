// Handle Add Student Modal
document.addEventListener("DOMContentLoaded", function () {
    const addStudentBtn = document.getElementById('add-student-btn');

    if (addStudentBtn) {
        addStudentBtn.addEventListener('click', function () {
            document.getElementById('add-student-form').setAttribute('action', '../../app/Views/components/addStudent.php');

            document.getElementById('student-id').value = '';
            document.getElementById('student-rfid').value = '';
            document.getElementById('first-name').value = '';
            document.getElementById('last-name').value = '';
            document.getElementById('student-email').value = '';
            document.getElementById('student-birthdate').value = '';
            document.getElementById('student-phone').value = '';
            document.getElementById('student-address').value = '';
            document.getElementById('student-gender').value = '';
            document.getElementById('guardian-name').value = '';
            document.getElementById('guardian-contact').value = '';
            document.getElementById('level').value = '';
            document.getElementById('course').value = '';
        });
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
                } else {
                    console.error('Error fetching student data:', data.message);
                }
            })
            .catch(error => console.error('AJAX error:', error));
    });
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