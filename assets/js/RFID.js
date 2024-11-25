document.addEventListener("DOMContentLoaded", function () {
    const recentStudentsContainer = document.getElementById("recent-students");
    const attendanceTableBody = document.getElementById("attendance-table-body");

    let recentStudents = [];
    let currentStudent = null;
    let rfidBuffer = ''; // Temporary storage for RFID data

    function loadAttendanceTable() {
        fetch("../Views/components/getAttendanceTable.php")
            .then(response => response.text())
            .then(html => {
                attendanceTableBody.innerHTML = html; // Update the table body
            })
            .catch(error => console.error("Error fetching attendance data:", error));
    }

    function updateRecentStudents() {
        recentStudentsContainer.innerHTML = "";
        recentStudents.slice(0, 3).forEach(student => {
            const card = document.createElement("div");
            card.classList.add("student-card");
            card.innerHTML = `
                <div class="card-content">
                    <div class="image-container">
                        <img src="${student.profile_picture}" alt="${student.full_name}" class="small-avatar">
                    </div>
                    <div class="student-details">
                        <div>
                            <div class="student-info">${student.full_name}</div>
                            <div class="student-info">${student.department}</div>
                        </div>
                        <span class="student-status ${student.status === "IN" ? "status-in" : "status-out"}">${student.status}</span>
                    </div>
                </div>
            `;
            recentStudentsContainer.appendChild(card);
        });
    }

    function processRFID(rfid) {
        fetch("../Views/components/markAttendance.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ rfid: rfid })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (currentStudent && currentStudent.student_id !== data.student.student_id) {
                        if (recentStudents.length === 3) {
                            recentStudents.pop(); // Limit recent students list to 3
                        }
                        recentStudents.unshift(currentStudent);
                    }

                    currentStudent = {
                        student_id: data.student.student_id,
                        full_name: data.student.full_name,
                        date: new Date().toLocaleDateString(),
                        time_in: data.status === "IN" ? data.time : "",
                        time_out: data.status === "OUT" ? data.time : "",
                        status: data.status,
                        profile_picture: data.student.profile_picture,
                        department: data.student.department
                    };

                    document.getElementById("current-student-avatar").src = data.student.profile_picture;
                    document.getElementById("current-student-name").textContent = data.student.full_name;
                    document.getElementById("current-department").textContent = data.student.department;

                    const statusLabel = document.getElementById("current-status");
                    statusLabel.textContent = data.status === "IN" ? "Checked In" : "Checked Out";
                    statusLabel.className = data.status === "IN" ? "status-in" : "status-out";

                    updateRecentStudents();
                    loadAttendanceTable();
                } else {
                    alert(data.message || "Failed to log attendance.");
                }
            })
            .catch(error => console.error("Error processing RFID:", error));
    }

    // Capture keystrokes to detect RFID input
    document.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            processRFID(rfidBuffer.trim());
            rfidBuffer = '';
        } else {
            rfidBuffer += event.key;
        }
    });

    loadAttendanceTable(); // Initial load of the attendance table
});