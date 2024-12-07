document.addEventListener("DOMContentLoaded", function () {
    const recentStudentsContainer = document.getElementById("recent-students");
    const attendanceTableBody = document.getElementById("attendance-table-body");

    let recentStudents = [];
    let currentStudent = null;
    let rfidBuffer = '';
    let countdownInterval = null;

    function loadAttendanceTable() {
        fetch("../Views/components/getAttendanceTable.php")
            .then(response => response.text())
            .then(html => {
                attendanceTableBody.innerHTML = html;
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

    // Function to start the countdown when in waiting period
    function startCountdown(timeRemaining, status) {
        const statusLabel = document.getElementById("current-status");

        // Clear any existing countdown
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }

        if (timeRemaining > 0) {
            // Set initial color based on waiting status
            statusLabel.className = status === "Waiting Period Out" ? "status-out" : "status-in";
            
            countdownInterval = setInterval(() => {
                if (timeRemaining <= 0) {
                    clearInterval(countdownInterval);
                    countdownInterval = null;
                    statusLabel.textContent = status === "Waiting Period Out" ? "You can now check out." : "You can now check in.";
                    statusLabel.className = status === "Waiting Period Out" ? "status-out" : "status-in";
                    console.log(status);
                    console.log("Countdown complete.");
                } else {
                    statusLabel.textContent = `Wait ${timeRemaining} seconds`;
                    timeRemaining--;
                    console.log(`Countdown at ${timeRemaining} seconds`);
                }
            }, 1000);
        }
    }

    function processRFID(rfid) {
        // Clear any existing countdown first
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }

        fetch("../Views/components/markAttendance.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ rfid: rfid })
        })
            .then(response => response.json())
            .then(data => {
                console.log("Response from server:", data); // Debug log

                // Always update the UI with current student info
                document.getElementById("current-student-avatar").src = data.student.profile_picture;
                document.getElementById("current-student-name").textContent = data.student.full_name;
                document.getElementById("current-department").textContent = data.student.department;
                const statusLabel = document.getElementById("current-status");

                if (!data.success && (data.status === "Waiting Period In" || data.status === "Waiting Period Out")) {
                    console.log("Waiting period status:", data.status); // Debug log
                    statusLabel.textContent = `Wait ${Math.ceil(data.timeRemaining)} seconds`;
                    statusLabel.className = data.status === "Waiting Period Out" ? "status-out" : "status-in";
                    startCountdown(Math.ceil(data.timeRemaining), data.status);
                    return;
                }

                if (data.success) {
                    console.log("Successful scan status:", data.status); // Debug log
                    sendSmsNotification(data.student.guardian_contact,
                        `Good day! ${data.student.guardian_name}, your child ${data.student.full_name} has ${data.status === 'IN' ? 'entered' : 'exited'} the school at ${data.time}.`);
                    if (currentStudent && currentStudent.student_id !== data.student.student_id) {
                        if (recentStudents.length === 3) {
                            recentStudents.pop();
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

                    statusLabel.textContent = data.status === "IN" ? "Checked In" : "Checked Out";
                    statusLabel.className = data.status === "IN" ? "status-in" : "status-out";

                    updateRecentStudents();
                    loadAttendanceTable();
                } else {
                    document.getElementById("current-student-name").textContent = "";
                    document.getElementById("current-department").textContent = "";
                    console.log("Invalid student or error");
                    statusLabel.textContent = "Invalid Student";
                    statusLabel.className = "status-out";
                }
            })
            .catch(error => { 
                console.error("Error processing RFID:", error);
                const statusLabel = document.getElementById("current-status");
                statusLabel.textContent = "Error processing card";
                statusLabel.className = "status-out";
            });
    }

    // sms notification
    function sendSmsNotification(phoneNumber, message) {
        fetch("../Views/components/sendSMS.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                phone_number: phoneNumber,
                message: message
            })
        })
            .then(response => response.json())
            .then(result => {
                const response = result.data && result.data.responses && result.data.responses[0];

                if (response && response.success) {
                    console.log("SMS sent successfully! Message ID:", response.messageId);
                } else {
                    const errorMessage = response && response.message || "Unknown error from TextBee";
                    if (response && !response.success) {
                    }
                }
            })
            .catch(err => {
                console.error("Error in SMS notification:", err);
            });
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

    loadAttendanceTable();
});