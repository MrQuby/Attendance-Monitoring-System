<?php
    session_start();

    $section = isset($_GET['section']) ? $_GET['section'] : 'dashboard';
    
    require_once(__DIR__ . '/../Models/SessionManager.php');
    require_once(__DIR__ . '/../config/database.php');
    require_once(__DIR__ . '/../Models/Student.php');
    require_once(__DIR__ . '/../Models/Teacher.php');
    require_once(__DIR__ . '/../Models/Course.php');

    SessionManager::startSession();
    if (!SessionManager::isAdminLoggedIn()) {
        header('Location: ../../app/Views/auth/loginScreen.php');
        exit;
    }

    // Set session data for logging
    $_SESSION['user_type'] = 'admin';
    $_SESSION['admin'] = [
        'admin_id' => $_SESSION['admin_id'],
        'admin_firstname' => $_SESSION['admin_firstname'],
        'admin_lastname' => $_SESSION['admin_lastname']
    ];

    // Initialize Models
    $teacherModel = new Teacher($pdo);
    $totalTeachers = $teacherModel->countTotalTeachers();

    $studentModel = new Student($pdo);
    $courseModel = new Course($pdo);

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

    // Check if editing a student (if 'edit_id' is set in the URL)
    $editStudent = null;
    if (isset($_GET['edit_id'])) {
        $editStudentId = $_GET['edit_id'];
        $editStudent = $studentModel->getStudentById($editStudentId);
    }

    // Check for success or error messages in the session
    $addStudentSuccess = isset($_SESSION['add_student_success']);
    $deleteStudentSuccess = isset($_SESSION['delete_student_success']);
    $editSuccess = isset($_SESSION['edit_student_success']);
    unset($_SESSION['add_student_success']);
    unset($_SESSION['delete_student_success']);
    unset($_SESSION['edit_student_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                    <li><a href="adminDashboard.php?section=dashboard" class="sidebar-link <?php echo ($section === 'dashboard') ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="adminDashboard.php?section=student-list" class="sidebar-link <?php echo ($section === 'student-list') ? 'active' : ''; ?>"><i class="fas fa-user-graduate"></i> Student</a></li>
                    <li><a href="adminDashboard.php?section=teacher-list" class="sidebar-link <?php echo ($section === 'teacher-list') ? 'active' : ''; ?>"><i class="fas fa-chalkboard-teacher"></i> Teachers</a></li>
                    <li><a href="adminDashboard.php?section=course-list" class="sidebar-link <?php echo ($section === 'course-list') ? 'active' : ''; ?>"><i class="fas fa-book"></i> Courses</a></li>
                    <li><a href="adminDashboard.php?section=user-logs" class="sidebar-link <?php echo ($section === 'user-logs') ? 'active' : ''; ?>"><i class="fas fa-history"></i> User Logs</a></li>
                    <li><a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
            <!-- Admin Profile -->
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <div class="user-info">
                    <h3>Admin</h3>
                    <p><?php echo htmlspecialchars($_SESSION['admin_email']); ?></p>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <div class="main-content">
            <header class="header">
                <div class="welcome-message">
                    <h1>Welcome back, <span><?php echo htmlspecialchars($_SESSION['admin_firstname'] . ' ' . $_SESSION['admin_lastname']); ?></span></h1>
                </div>
                <div class="datetime-display">
                    <h1 id="current-time"></h2>
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
                                    <h3 style="font-size: 30px"><?php echo count($students); ?></h3>
                                    <p style="font-size: 25px">Total Students</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Total Teachers -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="small-box bg-purple shadow-sm">
                                <div class="inner">
                                    <h3 style="font-size: 30px"><?php echo $totalTeachers; ?></h3>
                                    <p style="font-size: 25px">Total Teachers</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
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
            <!-- User Logs Section -->
            <?php if (isset($_GET['section']) && $_GET['section'] == 'user-logs'): ?>
                <section class="user-logs">
                    <div class="scrollable-table-container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2>User Activity Logs</h2>
                            <div class="d-flex align-items-center">
                                <div class="form-group mb-0 me-2">
                                    <label for="searchInput" class="sr-only">Search Logs</label>
                                    <div class="search-input-container">
                                        <i class="fas fa-search"></i>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search Logs" style="min-width: 300px;">
                                    </div>
                                </div>
                                <select id="logTypeFilter" class="form-select me-2" style="width: auto;">
                                    <option value="all">All Users</option>
                                    <option value="admin">Admin Only</option>
                                    <option value="teacher">Teachers Only</option>
                                </select>
                                <input type="date" id="filterDate" class="form-control me-2">
                                <button type="button" class="btn btn-danger" onclick="resetFilters()">Reset</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-striped table-hover">
                                <colgroup>
                                    <col style="width: 7%;">
                                    <col style="width: 7%;">
                                    <col style="width: 7%;">
                                    <col style="width: 7%;">
                                    <col style="width: 59%;">
                                    <col style="width: 13%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Type</th>
                                        <th>Action</th>
                                        <th>IP Address</th>
                                        <th>Browser</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody id="logsTableBody">
                                    <?php
                                    require_once(__DIR__ . '/../Models/Logger.php');
                                    $logger = new Logger($pdo);
                                    $logs = $logger->getRecentLogs();
                                    
                                    foreach ($logs as $log) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($log['user_id']) . "</td>";
                                        echo "<td>" . ucfirst(htmlspecialchars($log['user_type'])) . "</td>";
                                        echo "<td>" . ucfirst(htmlspecialchars($log['action'])) . "</td>";
                                        echo "<td>" . htmlspecialchars($log['ip_address']) . "</td>";
                                        echo "<td>" . htmlspecialchars($log['browser_info']) . "</td>";
                                        echo "<td>" . htmlspecialchars($log['timestamp']) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- Student List Content -->
            <?php if (isset($_GET['section']) && $_GET['section'] == 'student-list'): ?>
                <section class="student-list">
                    <div class="scrollable-table-container">
                    <h2>Student List</h2>
                        <div class="d-flex justify-content-between align-items-center mb-3">                       
                            <!-- Add Student Button -->
                            <div>
                                <button type="button" class="btn btn-success me-2" id="add-student-btn" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Bulk Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#bulkUploadModal">Upload Students</a></li>
                                        <li><a class="dropdown-item" href="../../app/Views/components/downloadStudents.php?type=template">Download Template</a></li>
                                        <li><a class="dropdown-item" href="../../app/Views/components/downloadStudents.php?type=export">Export Students</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Filter search form positioned to the right and aligned in a row -->
                            <div class="d-flex align-items-center">
                                <!-- Search Input -->
                                <div class="form-group mb-0 me-2">
                                    <label for="student_search" class="sr-only">Search Students</label>
                                    <div class="search-input-container">
                                        <i class="fas fa-search"></i>
                                        <input type="text" id="student_search" class="form-control" placeholder="Search Students" style="min-width: 300px;">
                                    </div>
                                </div>
                                <!-- Reset Button -->
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('student_search').value=''; document.getElementById('student_search').dispatchEvent(new Event('input'));">Reset</button>
                            </div>
                        </div>
                        <!-- Student List Table -->
                        <div class = "table-container">
                            <table class="table table-striped table-hover">
                                <colgroup>
                                    <col style="width: 10%;">
                                    <col style="width: 17%;">
                                    <col style="width: 17%;">
                                    <col style="width: 13%;">
                                    <col style="width: 30%;">
                                    <col style="width: 13%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Year Level</th>
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
                                                <!-- Edit button with full data attributes -->
                                                <button class="btn btn-success btn-sm edit-student-btn" 
                                                    data-id="<?php echo $student['student_id'] ?? ''; ?>"
                                                    data-firstname="<?php echo $student['student_firstname'] ?? ''; ?>"
                                                    data-lastname="<?php echo $student['student_lastname'] ?? ''; ?>"
                                                    data-email="<?php echo $student['student_email'] ?? ''; ?>"
                                                    data-birthdate="<?php echo $student['student_birthdate'] ?? ''; ?>"
                                                    data-phone="<?php echo $student['student_phone'] ?? ''; ?>"
                                                    data-address="<?php echo $student['student_address'] ?? ''; ?>"
                                                    data-gender="<?php echo $student['student_gender'] ?? ''; ?>"
                                                    data-guardian-name="<?php echo $student['guardian_name'] ?? ''; ?>"
                                                    data-guardian-contact="<?php echo $student['guardian_contact'] ?? ''; ?>"
                                                    data-level="<?php echo $student['student_level'] ?? ''; ?>"
                                                    data-course="<?php echo $student['course_id'] ?? ''; ?>"
                                                    data-profile-picture="<?php echo $student['profile_picture_path'] ?? 'path/to/default-profile-image.jpg'; ?>"
                                                    data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                                    <i class='bx bxs-edit'></i>
                                                </button>
                                                <!-- Delete button with only the icon displayed -->
                                                <form action="/app/Views/components/deleteStudent.php" method="post" style="display:inline-block;">
                                                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                                                    <button type="button" class="btn btn-danger btn-sm delete-student-btn">
                                                        <i class='bx bxs-trash'></i>
                                                    </button>
                                                </form>
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
            <!-- Teacher List Content -->
            <?php if (isset($_GET['section']) && $_GET['section'] == 'teacher-list'): ?>
                <section class="teacher-list">
                    <div class="scrollable-table-container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2>Teacher List</h2>
                            <div class="ms-auto">
                                <!-- Search Input -->
                                <div class="form-group mb-0 me-2 d-inline-block">
                                    <label for="teacher_search" class="sr-only">Search Teachers</label>
                                    <div class="search-input-container">
                                        <i class="fas fa-search"></i>
                                        <input type="text" id="teacher_search" class="form-control" placeholder="Search Teachers" style="min-width: 300px;">
                                    </div>
                                </div>
                                <!-- Reset Button -->
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('teacher_search').value=''; document.getElementById('teacher_search').dispatchEvent(new Event('input'));">Reset</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-striped table-hover">
                                <colgroup>
                                    <col style="width: 15%;">
                                    <col style="width: 25%;">
                                    <col style="width: 25%;">
                                    <col style="width: 35%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Teacher ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // You'll need to implement a method in the Teacher model to get teachers
                                    $teacherModel = new Teacher($pdo);
                                    $filterTeacherId = isset($_GET['filter_teacher_id']) ? $_GET['filter_teacher_id'] : null;
                                    $teachers = $teacherModel->getAllTeachers($filterTeacherId);
                                    
                                    if (!empty($teachers)): ?>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($teacher['teacher_id']); ?></td>
                                                <td><?php echo htmlspecialchars($teacher['teacher_firstname']); ?></td>
                                                <td><?php echo htmlspecialchars($teacher['teacher_lastname']); ?></td>
                                                <td><?php echo htmlspecialchars($teacher['teacher_email']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center" style="padding: 20px 0;">No teachers found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </section>
            <?php endif; ?>
            <!-- Course List Content -->
            <?php if (isset($_GET['section']) && $_GET['section'] == 'course-list'): ?>
                <section class="course-list">
                    <div class="scrollable-table-container">
                        <h2>Course List</h2>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Add Course Button -->
                            <div>
                                <button type="button" class="btn btn-success me-2" id="add-course-btn" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-striped table-hover">
                                <colgroup>
                                    <col style="width: 10%;">
                                    <col style="width: 30%;">
                                    <col style="width: 50%;">
                                    <col style="width: 10%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Course ID</th>
                                        <th>Course Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $courses = $courseModel->getAllCourses();
                                    if (!empty($courses)): 
                                        foreach ($courses as $course): 
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($course['course_id']); ?></td>
                                            <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                                            <td><?php echo htmlspecialchars($course['course_description']); ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-primary btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editCourseModal"
                                                            data-course-id="<?php echo htmlspecialchars($course['course_id']); ?>"
                                                            data-course-name="<?php echo htmlspecialchars($course['course_name']); ?>"
                                                            data-course-description="<?php echo htmlspecialchars($course['course_description']); ?>">
                                                        <i class='bx bxs-edit'></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteCourseModal"
                                                            data-course-id="<?php echo htmlspecialchars($course['course_id']); ?>">
                                                        <i class='bx bxs-trash'></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php 
                                        endforeach; 
                                    else: 
                                    ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No courses found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- Modals for View, Add, Edit, Delete -->
            <?php include __DIR__ . '/../Views/modals/viewStudentModal.php'; ?>
            <?php include __DIR__ . '/../Views/modals/addStudentModal.php'; ?>
            <?php include __DIR__ . '/../Views/modals/editStudentModal.php'; ?>
            <?php include __DIR__ . '/../Views/modals/deleteStudentModal.php'; ?>
            <?php include __DIR__ . '/../Views/modals/courseModals.php'; ?>
            <!-- Logout Confirmation Modal -->
            <?php include __DIR__ . '/../Views/modals/logoutConfirmationModal.php'; ?>
        </div>
    </div>
    <!-- Loading Animation -->
    <?php include __DIR__ . '/../Views/layouts/logoutAnimation.php'; ?>
    <!-- Success Modals for Add, Edit, and Delete Actions -->
    <?php include __DIR__ . '/../Views/modals/successModals.php'; ?>
    <!-- Bulk Upload Modal -->
    <?php include __DIR__ . '/../Views/modals/bulkStudentUploadModal.php'; ?>

    <!-- JS -->
    <script src="../../assets/js/date.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/modals.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/logout.js"></script>
    <script src="../../assets/js/logs.js"></script>
    <script src="../../assets/js/course.js"></script>
    <script src="../../assets/js/studentBulkUpload.js"></script>
</body>
</html>
