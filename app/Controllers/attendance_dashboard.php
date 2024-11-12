<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Cecilia's College - Cebu, Inc.</title>
    <link rel="stylesheet" href="../../assets/css/attendance_dashboard.css">
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
                            <colgroup>
                                <col style="width: 15%;">
                                <col style="width: 30%;">
                                <col style="width: 15%;">
                                <col style="width: 15%;">
                                <col style="width: 25%;">
                            </colgroup>
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
                                <!-- Attendance table will be dynamically display here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/date.js"></script>
    <script src="../../assets/js/RFID.js"></script>
</body>
</html>
