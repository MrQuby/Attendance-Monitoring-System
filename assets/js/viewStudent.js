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