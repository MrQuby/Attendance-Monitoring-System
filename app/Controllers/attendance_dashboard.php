<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Cecilia's College - Cebu, Inc.</title>
    <style>
        /* Styling for the page layout */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; font-family: Arial, sans-serif; overflow: hidden; margin: 0; padding: 0;}
        .header { background-color: #1a75ff; color: white; padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; }
        .header-left { display: flex; align-items: center; gap: 20px; }
        .logo-img { width: 60px; height: 60px; }
        .main-content { background-color: #1a75ff; color: white; padding: 20px; height: calc(100vh - 80px); overflow: hidden;}
        .datetime-display { background-color: white; padding: 15px; border-radius: 5px; color: #1a75ff; margin-bottom: 20px; text-align: center; font-weight: 30px;}
        .content-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 20px; }
        .status-box, .student-card, .table-container { background-color: white; padding: 20px; border-radius: 5px; }
        .status-box { text-align: center; }
        .card-content { display: flex; flex-direction: column; align-items: center; text-align: center; }
        .image-container { width: 100%; display: flex; justify-content: center; margin-bottom: 10px; }
        .student-avatar { width: 100%; height: 550px; margin: 0 auto; display: block; }
        .small-avatar { width: 300px; height: 300px; display: block; }
        .student-details { display: flex; justify-content: space-between; align-items: center; width: 90%; margin-top: 10px; padding: 0 15px; }
        .student-info { color: #333; font-weight: bold; text-align: left; }
        .student-status { padding: 5px 15px; border-radius: 15px; font-weight: bold; font-size: 18px; text-align: center; }
        .status-label { background-color: #1a75ff; color: white; padding: 10px; margin: 10px 0; text-align: center; font-weight: bold; font-size: 30px; }
        .student-text { color: black; font-weight: bold; text-align: center; margin: 10px 0; font-size: 30px; }
        .students-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px; }
        .student-info { color: #333; font-weight: bold; text-align: left; }
        .student-status { padding: 5px 15px; border-radius: 15px; font-weight: bold; font-size: 24px; }
        .status-in { background-color: #28a745; color: white; padding: 10px; margin: 10px 0; text-align: center; font-weight: bold; font-size: 30px; border-radius: 5px; }
        .status-out { background-color: #dc3545; color: white; padding: 10px; margin: 10px 0; text-align: center; font-weight: bold; font-size: 30px; border-radius: 5px; }
        .table-container { height: 300px; overflow-y: auto; border: 1px solid #ddd; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border: 1px solid #ddd; color: black; }
        th { background-color: #34495e; color: #fff; position: sticky; top: 0; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <img src="" alt="College Logo" class="logo-img">
            <h1></h1>
        </div>
        <img src="" alt="Secondary Logo" class="logo-img">
    </div>

    <div class="main-content">
        <!-- Date and Time Display -->
        <div class="datetime-display">
            <h2 id="current-time">SUNDAY MAY 19, 2024, 11:34:53 PM</h2>
        </div>

        <div class="content-grid">
            <!-- Current Student Status Box -->
            <div class="status-box">
                <img src="../../uploads/profile.jpg" alt="Student Avatar" class="student-avatar" id="current-student-avatar">
                <div class="status-label" id="current-status">STATUS</div>
                <div class="student-text" id="current-student-name">STUDENT NAME</div>
                <div class="student-text" id="current-department">DEPARTMENT</div>
            </div>

            <!-- Recent Students and Attendance Table -->
            <div>
                <div class="students-grid" id="recent-students">
                    <!-- Student cards will be dynamically inserted here -->
                </div>

                <div class="status-box">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Full Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-table-body">
                                <!-- Attendance data will be dynamically inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden RFID Input -->
    <input type="text" id="rfid-input" autofocus style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px; border: none;">

    <script>
        // Function to format and update the current time
        function updateTime() {
            const now = new Date();
            
            // Format options
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString('en-US', options).toUpperCase(); // Format the date part
            const timeString = now.toLocaleTimeString(); // Format the time part
            
            // Set formatted time
            document.getElementById('current-time').textContent = `${dateString}, ${timeString}`;
        }

        // Initial call to display the time right away
        updateTime();

        // Update the time every second
        setInterval(updateTime, 1000);
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const attendanceTableBody = document.getElementById("attendance-table-body");
        const recentStudentsContainer = document.getElementById("recent-students");
        const rfidInput = document.getElementById("rfid-input");

        let recentStudents = [];
        let currentStudent = null; // Holds the current student displayed in the main section

        function loadAttendanceData() {
            fetch("../Views/components/get_attendance_data.php")
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTable(data.data);
                    }
                })
                .catch(error => console.error("Error fetching attendance data:", error));
        }

        function updateTable(records) {
            attendanceTableBody.innerHTML = ""; // Clear existing table rows
            records.forEach(record => {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${record.student_id}</td>
                    <td>${record.full_name || record.student_firstname + ' ' + record.student_lastname}</td>
                    <td>${record.time_in || ""}</td>
                    <td>${record.time_out || ""}</td>
                    <td>${record.date}</td>
                `;
                attendanceTableBody.appendChild(newRow);
            });
        }

        function updateRecentStudents() {
            recentStudentsContainer.innerHTML = ""; // Clear recent students display
            recentStudents.slice(0, 3).forEach(student => { // Show only the last three entries
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
            fetch("../Views/components/mark_attendance.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ rfid: rfid })
            })
            .then(response => response.text())
            .then(text => {
                console.log("Raw response:", text);
                const data = JSON.parse(text);
                if (data.success) {
                    // Move current student to recent list only if it's a new student
                    if (currentStudent && currentStudent.student_id !== data.student.student_id) {
                        if (recentStudents.length === 3) {
                            recentStudents.pop(); // Limit recent students list to 3
                        }
                        recentStudents.unshift(currentStudent);
                    }

                    // Update the main student display with new student data
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

                    // Update main screen with student details
                    document.getElementById("current-student-avatar").src = data.student.profile_picture;
                    document.getElementById("current-student-name").textContent = data.student.full_name;
                    document.getElementById("current-department").textContent = data.student.department;

                    // Update status label with color change
                    const statusLabel = document.getElementById("current-status");
                    statusLabel.textContent = data.status === "IN" ? "Checked In" : "Checked Out";
                    statusLabel.className = data.status === "IN" ? "status-in" : "status-out";

                    // Update recent students display
                    updateRecentStudents();

                    // Refresh attendance table
                    loadAttendanceData();
                } else {
                    alert(data.message || "Failed to log attendance.");
                }
            })
            .catch(error => console.error("Error processing RFID:", error));
        }

        rfidInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                const rfid = rfidInput.value.trim();
                if (rfid) {
                    rfidInput.value = ""; // Clear the input field
                    processRFID(rfid); // Process the scanned RFID
                }
            }
        });

        loadAttendanceData();
    });
</script>



    
</body>
</html>
