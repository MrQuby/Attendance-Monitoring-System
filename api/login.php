<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once(__DIR__ . '/../app/Models/Teacher.php');
    require_once(__DIR__ . '/../app/Models/Admin.php');
    require_once(__DIR__ . '/../app/Models/SessionManager.php');
    require_once(__DIR__ . '/../app/config/database.php');

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // CSRF token validation
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $response = ['status' => 'error', 'message' => 'Invalid CSRF token'];
            $_SESSION['response'] = json_encode($response);
            header('Location: ../app/Views/auth/loginScreen.php');
            exit;
        }

        $id = $_POST['user_id'];
        $password = $_POST['user_password'];

        
        $admin = new Admin($pdo);

        $result = $admin->login($id, $password);

        if ($result['status'] === 'success') {
            SessionManager::startSession();
            SessionManager::loginAdmin($result['admin']);
            $_SESSION['success'] = "Welcome back, {$result['admin']['admin_firstname']} {$result['admin']['admin_lastname']}!";
            $_SESSION['redirect_url'] = '../../Controllers/adminDashboard.php';
            header('Location: ../app/Views/auth/loginScreen.php');
            exit;
        }
        
        $teacher = new Teacher($pdo);
        $result = $teacher->login($id, $password);

        if ($result['status'] === 'success') {
            SessionManager::startSession();
            SessionManager::loginTeacher($result['teacher']);
            $_SESSION['success'] = "Welcome back, {$result['teacher']['teacher_firstname']} {$result['teacher']['teacher_lastname']}!";
            $_SESSION['redirect_url'] = '../../Controllers/teacherDashboard.php';
            header('Location: ../app/Views/auth/loginScreen.php');
            exit;
        }

        $_SESSION['response'] = json_encode(['status' => 'error', 'message' => 'Invalid ID or password']);
        header('Location: ../app/Views/auth/loginScreen.php');
        exit;
    }
?>
