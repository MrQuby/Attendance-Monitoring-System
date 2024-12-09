<?php
session_start();
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../Models/Course.php');

$courseModel = new Course($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':
            $courseId = $_POST['course_id'] ?? '';
            $courseName = $_POST['course_name'] ?? '';
            $courseDescription = $_POST['course_description'] ?? '';

            $result = $courseModel->addCourse($courseId, $courseName, $courseDescription);
            
            if ($result === true) {
                $_SESSION['add_course_success'] = true;
            } elseif ($result === 'restored') {
                $_SESSION['add_course_success'] = true;
                $_SESSION['course_message'] = "Course was previously deleted. It has been restored with the new information.";
            } elseif ($result === 'exists') {
                $_SESSION['course_error'] = "This Course ID is currently in use. You cannot add a duplicate Course ID.";
                $_SESSION['show_add_course_modal'] = true;
                // Preserve the form data
                $_SESSION['form_data'] = [
                    'course_id' => $courseId,
                    'course_name' => $courseName,
                    'course_description' => $courseDescription
                ];
            } else {
                $_SESSION['course_error'] = "An error occurred while adding the course.";
                $_SESSION['show_add_course_modal'] = true;
                // Preserve the form data
                $_SESSION['form_data'] = [
                    'course_id' => $courseId,
                    'course_name' => $courseName,
                    'course_description' => $courseDescription
                ];
            }
            break;

        case 'edit':
            $courseId = $_POST['course_id'] ?? '';
            $courseName = $_POST['course_name'] ?? '';
            $courseDescription = $_POST['course_description'] ?? '';

            if ($courseModel->updateCourse($courseId, $courseName, $courseDescription)) {
                $_SESSION['edit_course_success'] = true;
            }
            break;

        case 'delete':
            $courseId = $_POST['course_id'] ?? '';

            if ($courseModel->softDeleteCourse($courseId)) {
                $_SESSION['delete_course_success'] = true;
            }
            break;
    }
}

header('Location: adminDashboard.php?section=course-list');
exit;
