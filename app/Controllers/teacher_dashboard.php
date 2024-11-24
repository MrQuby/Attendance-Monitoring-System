<?php
    session_start();

    $section = isset($_GET['section']) ? $_GET['section'] : 'dashboard';
    
    require_once(__DIR__ . '/../Models/SessionManager.php'); 
    require_once(__DIR__ . '/../config/database.php');
    require_once(__DIR__ . '/../Models/Student.php');

    SessionManager::startSession();
    if (!SessionManager::isTeacherLoggedIn()) {
        header('Location: ../../app/Views/auth/login_screen.php');
        exit;
    }

    $studentModel = new Student($pdo);

    $studentId = isset($_GET['student_id']) ? $_GET['student_id'] : null;
    $filterStudentId = isset($_GET['filter_student_id']) ? $_GET['filter_student_id'] : null;
    $filterDate = isset($_GET['filter_date']) ? $_GET['filter_date'] : null;

    $attendanceRecords = $studentModel->getAttendanceData($filterStudentId, $filterDate);
    $students = $studentModel->getAllStudents($studentId);
    $distinctCheckInTodayCount = $studentModel->countDistinctCheckInToday();
    $distinctCheckOutTodayCount = $studentModel->countDistinctCheckOutToday();

    $totalStudents = count($students);
    $attendancePercentage = ($totalStudents > 0) 
    ? ($distinctCheckInTodayCount / $totalStudents) * 100 
    : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="../../assets/css/teacher_dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div>
                <div class="logo">
                    <div class="logo-icon">👤</div>
                    <h1>SCC-ITECH<br>SOCIETY</h1>
                </div>
                <ul class="sidebar-menu">
                    <li><a href="teacher_dashboard.php?section=dashboard" class="sidebar-link <?php echo ($section === 'dashboard') ? 'active' : ''; ?>"><i class="bx bxs-grid-alt"></i> Dashboard</a></li>
                    <li><a href="teacher_dashboard.php?section=student-list" class="sidebar-link <?php echo ($section === 'student-list') ? 'active' : ''; ?>"><i class="bx bx-group"></i> Student</a></li>
                    <li><a href="teacher_dashboard.php?section=attendance" class="sidebar-link <?php echo ($section === 'attendance') ? 'active' : ''; ?>"><i class="bx bx-calendar"></i> Attendance</a></li>
                    <li><a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bx bx-log-out"></i>Logout</a></li>
                </ul>
            </div>
            <!-- User Profile -->
            <div class="user-profile">
                <div class="user-avatar">T</div>
                <div class="user-info">
                    <h3>Teacher</h3>
                    <p><?php echo htmlspecialchars($_SESSION['teacher_email']); ?></p>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <div class="main-content">
            <header class="header">
                <div class="welcome-message">
                    <h1>Welcome back, <span><?php echo htmlspecialchars($_SESSION['teacher_firstname'] . ' ' . $_SESSION['teacher_lastname']); ?></span></h1>
                </div>
                <div class="datetime-display">
                    <h2 id="current-time"></h2>
                </div>
            </header>
            <!-- Dashboard Content -->
            <?php if (!isset($_GET['section']) || $_GET['section'] == 'dashboard'): ?>
                <section class="dashboard">
                    <h2>Dashboard</h2>
                    <div class="row">
                        <!-- Total Students -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="small-box bg-aqua shadow-sm">
                                <div class="inner">
                                    <h3 style="font-size: 2rem"><?php echo $totalStudents; ?></h3>
                                    <p style="font-size: 1.5rem">Total Students</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Total Attendance Percentage -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="small-box bg-green shadow-sm">
                                <div class="inner">
                                    <h3 style="font-size: 2rem"><?php echo round($attendancePercentage); ?><sup >%</sup></h3>
                                    <p style="font-size: 1.5rem">Attendance Percentage</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Total Checked IN Today -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="small-box bg-red shadow-sm">
                                <div class="inner">
                                    <h3 style="font-size: 2rem"><?php echo $distinctCheckInTodayCount; ?></h3>
                                    <p style="font-size: 1.5rem">Checked In Today</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Total Checked OUT Today -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="small-box bg-yellow shadow-sm">
                                <div class="inner">
                                    <h3 style="font-size: 2rem"><?php echo $distinctCheckOutTodayCount; ?></h3>
                                    <p style="font-size: 1.5rem">Checked Out Today</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- Student List Content -->
            <?php if (isset($_GET['section']) && $_GET['section'] == 'student-list'): ?>
                <section class="student-list">
                    <div class="scrollable-table-container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2>Student List</h2>
                            <!-- Filter search -->
                            <form method="GET" action="teacher_dashboard.php" class="d-flex align-items-center">
                                <input type="hidden" name="section" value="student-list">
                                <!-- Search Input -->
                                <div class="form-group mb-0 me-2">
                                    <label for="student_id" class="sr-only">Search by Student ID</label>
                                    <input type="text" name="student_id" id="student_id" class="form-control" placeholder="Student ID" value="<?php echo isset($_GET['student_id']) ? $_GET['student_id'] : ''; ?>">
                                </div>
                                <!-- Search Button -->
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                                <!-- Reset Button -->
                                <a href="teacher_dashboard.php?section=student-list" class="btn btn-danger">Reset</a>
                            </form>
                        </div>
                        <!-- Student List Table -->                   
                        <div class = "table-container">
                            <table class="table table-striped table-hover">
                                <colgroup>
                                    <col style="width: 10%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 10%;">
                                    <col style="width: 32%;">
                                    <col style="width: 8%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Year & Level</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($students)): ?>
                                        <?php foreach ($students as $student): ?>
                                        <tr>
                                            <td><?php echo $student['student_id']; ?></td>
                                            <td>
                                                <div class="profile-container">
                                                    <img src="<?php echo !empty($student['profile_picture']) 
                                                        ? '/' . $student['profile_picture'] 
                                                        : '/uploads/default.png'; ?>" 
                                                        alt="Profile Picture" 
                                                        class="profile-pic">
                                                    <span><?php echo htmlspecialchars($student['student_firstname'] . ' ' . $student['student_lastname']); ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo $student['student_email'] ?? 'N/A'; ?></td>
                                            <td><?php echo $student['student_level']; ?></td>
                                            <td><?php echo $student['course_name']; ?></td>
                                            <td>
                                                <!-- View Button -->
                                                <button class="btn btn-primary btn-sm view-student-btn"
                                                    data-id="<?php echo $student['student_id'] ?? ''; ?>"
                                                    data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                                                    <i class='bx bx-show'></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center" style="padding: 20px 0;">No students found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </section>
            <?php endif; ?>
            <!-- Attendance List Content -->
            <?php if (isset($_GET['section']) && $_GET['section'] == 'attendance'): ?>
                <section class="attendance">
                    <div class="scrollable-table-container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2>Attendance List</h2>
                            <form method="GET" action="teacher_dashboard.php" class="d-flex align-items-center">
                                <input type="hidden" name="section" value="attendance">
                                <!-- Student ID Filter -->
                                <div class="form-group mb-0 me-2">
                                    <label for="filter_student_id" class="sr-only">Student ID</label>
                                    <input type="text" name="filter_student_id" id="filter_student_id" class="form-control" placeholder="Student ID" value="<?php echo isset($_GET['filter_student_id']) ? $_GET['filter_student_id'] : ''; ?>">
                                </div>
                                <!-- Date Filter -->
                                <div class="form-group mb-0 me-2">
                                    <label for="filter_date" class="sr-only">Date</label>
                                    <input type="date" name="filter_date" id="filter_date" class="form-control" value="<?php echo isset($_GET['filter_date']) ? $_GET['filter_date'] : ''; ?>">
                                </div>
                                <!-- Search Button -->
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                                <!-- Reset Button -->
                                <a href="teacher_dashboard.php?section=attendance" class="btn btn-danger">Reset</a>
                            </form>
                        </div>
                        <div class="table-container">
                            <table class="table table-striped table-hover">
                                <colgroup>
                                    <col style="width: 10%;">
                                    <col style="width: 24%;">
                                    <col style="width: 10%;">
                                    <col style="width: 25%;">
                                    <col style="width: 15%;">
                                    <col style="width: 8%;">
                                    <col style="width: 8%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student</th>
                                        <th>Year & Level</th>
                                        <th>Course</th>
                                        <th>Date</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($attendanceRecords)): ?>
                                        <?php foreach ($attendanceRecords as $record): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($record['student_id']); ?></td>
                                                <td>
                                                    <div class="profile-container">
                                                        <img src="<?php echo $record['profile_picture']
                                                        ? '/' . $record['profile_picture']
                                                        :'/uploads/profile.jpg';?>"
                                                            alt="Profile Picture" 
                                                            class="profile-pic">
                                                        <span><?php echo htmlspecialchars($record['full_name']); ?></span>
                                                    </div>
                                                </td>
                                                <td><?php echo htmlspecialchars($record['student_level']); ?></td>
                                                <td><?php echo htmlspecialchars($record['course_name']); ?></td>
                                                <td><?php echo date("F d, Y", strtotime($record['date'])); ?></td>
                                                <td style="color: <?php echo $record['time_in'] ? 'green' : 'gray'; ?>">
                                                    <?php echo $record['time_in'] ? date("h:i A", strtotime($record['time_in'])) : 'N/A'; ?></td>
                                                <td style="color: <?php echo $record['time_out'] ? 'red' : 'gray'; ?>">
                                                    <?php echo $record['time_out'] ? date("h:i A", strtotime($record['time_out'])) : 'N/A'; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center" style="padding: 20px 0;">No attendance records found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                </section>
            <?php endif; ?>
            <!-- Modals for View -->
            <?php include __DIR__ . '/../Views/modals/view_student_modal.php'; ?>
            <!-- Logout Confirmation Modal -->
            <?php include __DIR__ . '/../Views/modals/logout_confirmation_modal.php'; ?>
        </div>
    </div>
    <!-- Loading Animation -->
    <?php include __DIR__ . '/../Views/layouts/logout_animation.php'; ?>
    <!-- JS -->
    <script src="../../assets/js/date.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/modals.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/logout.js"></script>
</body>
</html>
