<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once(__DIR__ . '/../app/Models/Teacher.php');
    require_once(__DIR__ . '/../app/Models/SessionManager.php');
    require_once(__DIR__ . '/../app/config/database.php');

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // CSRF token validation
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $response = ['status' => 'error', 'message' => 'Invalid CSRF token'];
            $_SESSION['response'] = json_encode($response);
            header('Location: ../index.php');
            exit;
        }

        $teacher_id = $_POST['teacher_id'];
        $password = $_POST['teacher_password'];

        $teacher = new Teacher($pdo);
        $result = $teacher->login($teacher_id, $password);

        if ($result['status'] === 'success') {
            SessionManager::startSession();
            SessionManager::loginTeacher($result['teacher']);
            header('Location: ../app/Controllers/teacher_dashboard.php');
            exit;
        } else {
            $_SESSION['response'] = json_encode($result);
            header('Location: ../index.php');
            exit;
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid request method'];
        $_SESSION['response'] = json_encode($response);
        header('Location: ../index.php');
    }
?>
