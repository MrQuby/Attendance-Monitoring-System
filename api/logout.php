<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');

    require_once('../app/Models/SessionManager.php');

    // Logout the teacher
    SessionManager::logoutTeacher();

    // Return a success message
    echo json_encode(['status' => 'success', 'message' => 'You have been logged out.']);
?>
