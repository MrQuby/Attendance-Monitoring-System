document.addEventListener('DOMContentLoaded', () => {
    // Get references to the menu links
    const dashboardLink = document.getElementById('dashboard-link');
    const studentListLink = document.getElementById('student-list-link');
    const attendanceLink = document.getElementById('attendance-link'); // Corrected variable name

    // Get references to the content sections
    const dashboardSection = document.getElementById('dashboard');
    const studentListSection = document.getElementById('student-list');
    const attendanceListSection = document.getElementById('attendance'); // Corrected ID

    // Modal related variables
    const studentModal = document.getElementById('student-modal');
    const closeModal = studentModal.querySelector('.close');
    const addStudentButton = document.getElementById('add-student-btn');


    // Function to hide all sections
    function hideAllSections() {
        dashboardSection.style.display = 'none';
        studentListSection.style.display = 'none';
        attendanceListSection.style.display = 'none';
    }

    // Function to remove active class from all links
    function removeActiveClasses() {
        dashboardLink.classList.remove('active');
        studentListLink.classList.remove('active');
        attendanceLink.classList.remove('active'); // Corrected target
    }

    // Event listener for Dashboard link
    dashboardLink.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default link behavior
        hideAllSections();
        removeActiveClasses();
        dashboardSection.style.display = 'block';
        dashboardLink.classList.add('active');
    });

    // Event listener for Student List link
    studentListLink.addEventListener('click', (e) => {
        e.preventDefault();
        hideAllSections();
        removeActiveClasses();
        studentListSection.style.display = 'block';
        studentListLink.classList.add('active');
    });

    // Event listener for Attendance link
    attendanceLink.addEventListener('click', (e) => { // Corrected variable name
        e.preventDefault(); // Prevent default link behavior
        hideAllSections();
        removeActiveClasses();
        attendanceListSection.style.display = 'block';
        attendanceLink.classList.add('active'); // Corrected target
    });

    addStudentButton.addEventListener('click', () => {
        studentModal.style.display = 'block'; // Show the modal
    });

    // Event listener for closing the modal
    closeModal.addEventListener('click', () => {
        studentModal.style.display = 'none'; // Hide the modal
    });

    // Click outside of the modal to close it
    window.addEventListener('click', (event) => {
        if (event.target === studentModal) {
            studentModal.style.display = 'none';
        }
    });


    // Initialize by showing the dashboard
    dashboardLink.click();
});

