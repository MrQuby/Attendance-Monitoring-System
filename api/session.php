<?php
    session_start();

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');

    require_once(__DIR__ . '/app/Models/SessionManager.php');

    // Check if the user is logged in by verifying the session
    if (!SessionManager::isTeacherLoggedIn()) {
        echo json_encode(['status' => 'error', 'message' => 'You are not logged in.']);
        exit;
    }

    // User is logged in, return teacher info
    echo json_encode(['status' => 'success', 'teacher' => SessionManager::getTeacherInfo()]);
?>
