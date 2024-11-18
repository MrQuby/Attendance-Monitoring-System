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

    // Collect input values
    $teacher_id = trim($_POST['teacher_id']);
    $first_name = ucwords(strtolower(trim($_POST['teacher_firstname'])));
    $last_name = ucwords(strtolower(trim($_POST['teacher_lastname'])));
    $email = trim($_POST['teacher_email']);
    $password = trim($_POST['teacher_password']);
    $confirm_password = trim($_POST['teacher_confirm_password']);

    // Initialize errors and input data arrays
    $_SESSION['errors'] = [];
    $_SESSION['input_data'] = $_POST;

    // Clear passwords from session data after saving input data
    unset($_SESSION['input_data']['teacher_password'], $_SESSION['input_data']['teacher_confirm_password']);

    // Check if ID or email already exists
    $teacher = new Teacher($pdo);
    $existingErrors = $teacher->checkExistence($teacher_id, $email);

    if (!empty($existingErrors)) {
        $_SESSION['errors'] = array_merge($_SESSION['errors'], $existingErrors);
    }

    // Proceed with other validations
    if (empty($teacher_id)) {
        $_SESSION['errors']['teacher_id'] = 'ID Number is required.';
    } elseif (!preg_match('/^SCC-\d+$/', $teacher_id)) {
        $_SESSION['errors']['teacher_id'] = 'ID must be in the format SCC- followed by numbers.';
    }

    if (empty($first_name)) {
        $_SESSION['errors']['teacher_firstname'] = 'First Name is required.';
    }
    if (empty($last_name)) {
        $_SESSION['errors']['teacher_lastname'] = 'Last Name is required.';
    }

    // General email validation to accept all domains
    if (empty($email)) {
        $_SESSION['errors']['teacher_email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['teacher_email'] = 'Email format is invalid. Example: user@example.com';
    }

    // Password validation
    $passwordErrors = [];
    if (empty($password)) {
        $passwordErrors[] = 'Password is required.';
    } else {
        if (strlen($password) < 8) {
            $passwordErrors[] = 'Password must be at least 8 characters long.';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $passwordErrors[] = 'Password must contain at least one uppercase letter.';
        }
        if (!preg_match('/[\W_]/', $password)) {
            $passwordErrors[] = 'Password must contain at least one special character.';
        }
    }

    // If there are password errors, add them to the session errors
    if (!empty($passwordErrors)) {
        $_SESSION['errors']['teacher_password'] = implode(' ', $passwordErrors);
    }

    // Confirm password validation
    if (empty($confirm_password)) {
        $_SESSION['errors']['teacher_confirm_password'] = 'Confirm Password is required.';
    } elseif ($password !== $confirm_password) {
        $_SESSION['errors']['teacher_confirm_password'] = 'Passwords do not match.';
    }

    // If there are any validation errors, redirect back with errors
    if (!empty($_SESSION['errors'])) {
        $_SESSION['validation_error'] = true;
        header('Location: ../app/Views/auth/signup_screen.php');
        exit;
    }

    // Register teacher if no validation errors
    $result = $teacher->register($teacher_id, $first_name, $last_name, $email, $password);

    // Handle registration response
    if ($result['status'] === 'success') {
        $_SESSION['success'] = 'Your account has been created successfully.';
        unset($_SESSION['input_data'], $_SESSION['validation_error']);
        header('Location: ../app/Views/auth/signup_screen.php');
    } else {
        $_SESSION['errors']['general'] = $result['message'];
        $_SESSION['validation_error'] = true;
        header('Location: ../app/Views/auth/signup_screen.php');
    }
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header('Location: ../app/Views/auth/signup_screen.php');
}
