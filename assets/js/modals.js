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

    // Handle real-time student search
    const searchInput = document.getElementById('student_search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const studentTable = document.querySelector('.student-list table tbody');
            const rows = studentTable.getElementsByTagName('tr');

            for (let row of rows) {
                // Skip if it's the "No students found" row
                if (row.cells.length === 1 && row.cells[0].hasAttribute('colspan')) {
                    continue;
                }

                const id = row.cells[0]?.textContent.toLowerCase() || '';
                const name = row.cells[1]?.querySelector('span')?.textContent.toLowerCase() || '';
                const email = row.cells[2]?.textContent.toLowerCase() || '';
                const yearLevel = row.cells[3]?.textContent.toLowerCase() || '';
                const course = row.cells[4]?.textContent.toLowerCase() || '';

                if (id.includes(searchTerm) || 
                    name.includes(searchTerm) || 
                    email.includes(searchTerm) || 
                    yearLevel.includes(searchTerm) ||
                    course.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }

            // Show "No results found" message if no matches
            const visibleRows = Array.from(rows).filter(row => 
                row.style.display !== 'none' && 
                !(row.cells.length === 1 && row.cells[0].hasAttribute('colspan'))
            );

            const noResultsRow = studentTable.querySelector('.no-results');
            if (visibleRows.length === 0) {
                if (!noResultsRow) {
                    const newRow = document.createElement('tr');
                    newRow.className = 'no-results';
                    newRow.innerHTML = '<td colspan="6" class="text-center" style="padding: 20px 0;">No matching students found.</td>';
                    studentTable.appendChild(newRow);
                }
            } else if (noResultsRow) {
                noResultsRow.remove();
            }
        });
    }

    // Real-time search for teachers
    document.getElementById('teacher_search')?.addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('.teacher-list tbody tr');
        let hasVisibleRows = false;

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "No teachers found" message if no matching results
        const noTeachersRow = document.querySelector('.teacher-list .no-teachers-message');
        if (!hasVisibleRows) {
            if (!noTeachersRow) {
                const tbody = document.querySelector('.teacher-list tbody');
                const newRow = document.createElement('tr');
                newRow.className = 'no-teachers-message';
                newRow.innerHTML = '<td colspan="6" class="text-center" style="padding: 20px 0;">No teachers found.</td>';
                tbody.appendChild(newRow);
            } else {
                noTeachersRow.style.display = '';
            }
        } else if (noTeachersRow) {
            noTeachersRow.style.display = 'none';
        }
    });

    // Real-time search for attendance
    document.getElementById('attendance_search')?.addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('.attendance tbody tr');
        let hasVisibleRows = false;

        tableRows.forEach(row => {
            const id = row.cells[0]?.textContent.toLowerCase() || '';
            const name = row.cells[1]?.querySelector('span')?.textContent.toLowerCase() || '';
            const yearLevel = row.cells[2]?.textContent.toLowerCase() || '';
            const course = row.cells[3]?.textContent.toLowerCase() || '';

            if (id.includes(searchValue) || 
                name.includes(searchValue) || 
                yearLevel.includes(searchValue) || 
                course.includes(searchValue)) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "No attendance records found" message if no matching results
        const noRecordsRow = document.querySelector('.attendance .no-records-message');
        if (!hasVisibleRows) {
            if (!noRecordsRow) {
                const tbody = document.querySelector('.attendance tbody');
                const newRow = document.createElement('tr');
                newRow.className = 'no-records-message';
                newRow.innerHTML = '<td colspan="7" class="text-center" style="padding: 20px 0;">No attendance records found.</td>';
                tbody.appendChild(newRow);
            } else {
                noRecordsRow.style.display = '';
            }
        } else if (noRecordsRow) {
            noRecordsRow.style.display = 'none';
        }
    });

    // Date filter for attendance
    document.getElementById('filter_date')?.addEventListener('change', function(e) {
        const dateValue = e.target.value;
        const tableRows = document.querySelectorAll('.attendance tbody tr');
        let hasVisibleRows = false;

        tableRows.forEach(row => {
            const date = row.cells[4]?.textContent.trim().split(' ')[0] || ''; // Get just the date part
            if (date === dateValue) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "No attendance records found" message if no matching results
        const noRecordsRow = document.querySelector('.attendance .no-records-message');
        if (!hasVisibleRows) {
            if (!noRecordsRow) {
                const tbody = document.querySelector('.attendance tbody');
                const newRow = document.createElement('tr');
                newRow.className = 'no-records-message';
                newRow.innerHTML = '<td colspan="7" class="text-center" style="padding: 20px 0;">No attendance records found for selected date.</td>';
                tbody.appendChild(newRow);
            } else {
                noRecordsRow.style.display = '';
            }
        } else if (noRecordsRow) {
            noRecordsRow.style.display = 'none';
        }
    });

    // Function to filter logs
    function filterLogs() {
        const userType = document.getElementById('logTypeFilter').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        fetch('../api/getLogs.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                userType: userType,
                startDate: startDate,
                endDate: endDate
            })
        })
        .then(response => response.json())
        .then(data => {
            const logsTableBody = document.getElementById('logsTableBody');
            logsTableBody.innerHTML = '';

            data.forEach(log => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${log.user_id}</td>
                    <td>${log.user_type.charAt(0).toUpperCase() + log.user_type.slice(1)}</td>
                    <td>${log.action.charAt(0).toUpperCase() + log.action.slice(1)}</td>
                    <td>${log.ip_address}</td>
                    <td>${log.browser_info}</td>
                    <td>${log.timestamp}</td>
                `;
                logsTableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
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