<?php
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../Models/Student.php');

    $studentId = $_GET['student_id'];
    $studentModel = new Student($pdo);

    if ($studentId) {
        $student = $studentModel->getStudentById($studentId);
        if ($student) {
            echo json_encode(['status' => 'success', 'data' => $student]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Student not found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No student ID provided']);
    }
?>
