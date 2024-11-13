<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/../app/Models/Teacher.php');
require_once(__DIR__ . '/../app/config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = 'Invalid CSRF token';
        header('Location: ../app/Views/auth/signup_screen.php');
        exit;
    }

    $teacher_id = trim($_POST['teacher_id']);
    $first_name = trim($_POST['teacher_firstname']);
    $last_name = trim($_POST['teacher_lastname']);
    $email = trim($_POST['teacher_email']);
    $password = trim($_POST['teacher_password']);

    // Validate inputs
    if (empty($teacher_id) || empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../app/Views/auth/signup_screen.php');
        exit;
    }

    // Register teacher
    $teacher = new Teacher($pdo);
    $result = $teacher->register($teacher_id, $first_name, $last_name, $email, $password);

    // Redirect with success message if registration is successful
    if ($result['status'] === 'success') {
        $_SESSION['success'] = 'Registration successful! Please log in.';
        header('Location: ../app/Views/auth/signup_screen.php');
    } else {
        $_SESSION['error'] = $result['message'];
        header('Location: ../app/Views/auth/signup_screen.php');
    }
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header('Location: ../app/Views/auth/signup_screen.php');
}
?>
