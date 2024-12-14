<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Cecilia's College - Cebu, Inc.</title>
    <link rel="stylesheet" href="../../assets/css/attendanceDashboard.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="background-container">
        <div class="header">
            <div class="header-left">
                <img src="../../uploads/SCC logo.png" alt="College Logo" class="logo-img">
                <div>
                    <h1>ST. CECILIA'S COLLEGE - CEBU, INC.</h1>
                    <h2>Ward II, Minglanilla, Cebu</h2>
                </div>
            </div>
            <div class="header-right">
                <img src="../../uploads/DepEd text1.png" alt="DepEd Logo" class="logo-text">
                <img src="../../uploads/DepEd logo.png" alt="DepEd Logo" class="logo-img">
            </div>
        </div>

        <div class="main-content">
            <!-- Date and Time Display -->
            <div class="datetime-display">
                <div class="date-container">
                    <h2 id="current-date"></h2>
                </div>
                <div class="time-container">
                    <h2 id="current-time"></h2>
                </div>
            </div>

            <div class="content-grid">
                <!-- Current Student Status Box -->
                <div class="status-box">
                    <img src="../../uploads/pp.png" alt="Student Avatar" class="student-avatar" id="current-student-avatar">
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
                            <table class="table table-striped table-hover">
                                <colgroup>
                                    <col style="width: 15%;">
                                    <col style="width: 30%;">
                                    <col style="width: 25%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Full Name</th>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
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
    </div>
    <script src="../../assets/js/date.js"></script>
    <script src="../../assets/js/RFID.js"></script>
</body>
</html>
