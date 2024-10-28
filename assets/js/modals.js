// Handle Add Student Modal
// document.getElementById('add-student-btn').addEventListener('click', function() {
//     // Set modal label and form action for adding a new student
//     document.getElementById('add-student-form').setAttribute('action', '../../app/Views/components/add_student.php');

//     // Clear the modal fields for adding a new student
//     document.getElementById('student-id').value = '';
//     document.getElementById('first-name').value = '';
//     document.getElementById('last-name').value = '';
//     document.getElementById('student-email').value = '';
//     document.getElementById('student-birthdate').value = '';
//     document.getElementById('student-phone').value = '';
//     document.getElementById('student-address').value = '';
//     document.getElementById('student-gender').value = '';
//     document.getElementById('guardian-name').value = '';
//     document.getElementById('guardian-contact').value = '';
//     document.getElementById('level').value = '';
//     document.getElementById('course').value = '';
// });
document.addEventListener("DOMContentLoaded", function () {
    const addStudentBtn = document.getElementById('add-student-btn');
    
    if (addStudentBtn) {
        addStudentBtn.addEventListener('click', function () {
            // Set modal label and form action for adding a new student
            document.getElementById('add-student-form').setAttribute('action', '../../app/Views/components/add_student.php');

            // Clear the modal fields for adding a new student
            document.getElementById('student-id').value = '';
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

document.querySelectorAll('.edit-student-btn').forEach(button => {
    button.addEventListener('click', function() {
        const studentId = this.getAttribute('data-id');

        // Fetch student data via AJAX
        fetch(`/app/Views/components/get_student.php?student_id=${studentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const student = data.data;

                    // Populate form fields with student data
                    document.getElementById('student-id').value = student.student_id || '';
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

                    // Set profile picture if available, otherwise default image
                    document.getElementById('edit-profile-picture-display').src = student.profile_picture 
                        ? `/${student.profile_picture}` 
                        : '/uploads/default-profile-image.jpg';
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

// // Handle View Student Modal
// document.querySelectorAll('.view-student-btn').forEach(function(button) {
//     button.addEventListener('click', function() {
//         const studentId = this.getAttribute('data-id');
//         fetch(`/app/Views/components/get_student.php?student_id=${studentId}`)
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === 'success') {
//                     const student = data.data;

//                     // Populate the modal fields (view only)
//                     document.getElementById('view-student-id').value = student.student_id || '';
//                     document.getElementById('view-first-name').value = student.student_firstname || '';
//                     document.getElementById('view-last-name').value = student.student_lastname || '';
//                     document.getElementById('view-student-email').value = student.student_email || '';
//                     document.getElementById('view-student-birthdate').value = student.student_birthdate || '';
//                     document.getElementById('view-student-phone').value = student.student_phone || '';
//                     document.getElementById('view-student-gender').value = student.student_gender || '';
//                     document.getElementById('view-guardian-name').value = student.guardian_name || '';
//                     document.getElementById('view-guardian-contact').value = student.guardian_contact || '';
//                     document.getElementById('view-student-level').value = student.student_level || '';
//                     document.getElementById('view-course').value = student.course_id || '';
//                     document.getElementById('view-student-address').value = student.student_address || '';

//                     // Set profile picture with a default if none exists
//                     document.getElementById('view-profile-picture-display').src = student.profile_picture 
//                         ? `../${student.profile_picture}` 
//                         : '../uploads/default-profile-image.jpg';
//                 } else {
//                     console.error('Error fetching student data:', data.message);
//                 }
//             })
//             .catch(error => console.error('AJAX error:', error));
//     });
// });