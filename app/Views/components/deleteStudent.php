<?php
    session_start();
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../Models/Student.php');

    $studentModel = new Student($pdo);

    if ($_POST['student_id']) {
        $studentId = $_POST['student_id'];

        if ($studentModel->deleteStudent($studentId)) {
            $_SESSION['delete_student_success'] = true;
        }
        header('Location: ../../Controllers/adminDashboard.php?section=student-list');
        exit;
    }
?>
