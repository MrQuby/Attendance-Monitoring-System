<?php
require_once(__DIR__ . '/../app/config/database.php');
require_once(__DIR__ . '/../app/Models/Teacher.php');
require_once(__DIR__ . '/../app/Models/Admin.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        $response = ['status' => 'error', 'message' => '', 'debug' => []];
        
        // Log incoming data
        error_log("Reset password attempt - Data: " . json_encode([
            'token_length' => strlen($token),
            'password_length' => strlen($password),
            'passwords_match' => $password === $confirmPassword
        ]));
        
        if (empty($token) || empty($password) || empty($confirmPassword)) {
            $response['message'] = "All fields are required.";
            $response['debug']['missing_fields'] = [
                'token' => empty($token),
                'password' => empty($password),
                'confirm_password' => empty($confirmPassword)
            ];
            echo json_encode($response);
            exit;
        }
        
        if ($password !== $confirmPassword) {
            $response['message'] = "Passwords do not match.";
            echo json_encode($response);
            exit;
        }
        
        if (strlen($password) < 8) {
            $response['message'] = "Password must be at least 8 characters long.";
            echo json_encode($response);
            exit;
        }
        
        $teacher = new Teacher($pdo);
        $admin = new Admin($pdo);
        
        // Check token in both tables
        $teacherData = $teacher->findByResetToken($token);
        $adminData = $admin->findByResetToken($token);
        
        error_log("Token search results - " . json_encode([
            'token' => $token,
            'teacher_found' => !empty($teacherData),
            'admin_found' => !empty($adminData),
            'teacher_data' => $teacherData,
            'admin_data' => $adminData
        ]));
        
        $response['debug']['token_check'] = [
            'teacher_found' => !empty($teacherData),
            'admin_found' => !empty($adminData)
        ];
        
        if (!$teacherData && !$adminData) {
            $response['message'] = "Invalid or expired reset token.";
            echo json_encode($response);
            exit;
        }
        
        // Update password
        $success = false;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        if ($teacherData) {
            error_log("Attempting to update teacher password - ID: " . $teacherData['teacher_id']);
            $success = $teacher->updatePassword($teacherData['teacher_id'], $hashedPassword);
            if ($success) {
                $teacher->clearResetToken($teacherData['teacher_id']);
            }
            $response['debug']['update_attempt'] = [
                'type' => 'teacher',
                'id' => $teacherData['teacher_id'],
                'success' => $success
            ];
        } else {
            error_log("Attempting to update admin password - ID: " . $adminData['admin_id']);
            $success = $admin->updatePassword($adminData['admin_id'], $hashedPassword);
            if ($success) {
                $admin->clearResetToken($adminData['admin_id']);
            }
            $response['debug']['update_attempt'] = [
                'type' => 'admin',
                'id' => $adminData['admin_id'],
                'success' => $success
            ];
        }
        
        if ($success) {
            $response['status'] = 'success';
            $response['message'] = "Your password has been reset successfully.";
        } else {
            $response['message'] = "Failed to update password. Please try again.";
        }
        
        echo json_encode($response);
        
    } catch (Exception $e) {
        error_log("Password reset error: " . $e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => 'An unexpected error occurred.',
            'debug' => ['error' => $e->getMessage()]
        ]);
    }
    exit;
}
?>
