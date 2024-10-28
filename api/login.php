<?php
// Enable error reporting and set headers
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/../app/Models/Teacher.php');
require_once(__DIR__ . '/../app/Models/SessionManager.php');
require_once(__DIR__ . '/../app/config/database.php');

session_start();  // Start the session

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF token validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $response = ['status' => 'error', 'message' => 'Invalid CSRF token'];
        $_SESSION['response'] = json_encode($response);
        header('Location: ../index.php');
        exit;
    }

    // Get data from the request
    $teacher_id = $_POST['teacher_id'];
    $password = $_POST['teacher_password'];

    // Create an instance of the Teacher class and try to log in the teacher
    $teacher = new Teacher($pdo);
    $result = $teacher->login($teacher_id, $password);

    // If login is successful, store session data and redirect
    if ($result['status'] === 'success') {
        SessionManager::startSession();
        SessionManager::loginTeacher($result['teacher']);
        header('Location: ../app/Controllers/teacher_dashboard.php');
        exit;
    } else {
        // Store the JSON response (error message) in the session and redirect back to login page
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
