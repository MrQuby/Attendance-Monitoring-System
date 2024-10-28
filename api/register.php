<?php
    // Enable error reporting and set headers
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');

    require_once(__DIR__ . '/../app/Models/Teacher.php');
    require_once(__DIR__ . '/../app/config/database.php');

    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get data from the request
        $teacher_id = trim($_POST['teacher_id']);
        $first_name = trim($_POST['teacher_first_name']);
        $last_name = trim($_POST['teacher_last_name']);
        $password = trim($_POST['teacher_password']);

        // Validate input
        if (empty($teacher_id) || empty($first_name) || empty($last_name) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit;
        }

        // Create an instance of the Teacher class and register the teacher
        $teacher = new Teacher($pdo);
        $result = $teacher->register($teacher_id, $first_name, $last_name, $password);

        // Return the result
        echo json_encode($result);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }
?>
