<?php
    session_start();

    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../Models/Student.php');

    $studentModel = new Student($pdo);

    // Get form data
    $studentId = $_POST['student_id'];
    $studentRfid = $_POST['student_rfid'];
    $firstName = $_POST['student_firstname'];
    $lastName = $_POST['student_lastname'];
    $email = $_POST['student_email'];
    $birthdate = $_POST['student_birthdate'];
    $phone = $_POST['student_phone'];
    $address = $_POST['student_address'];
    $gender = $_POST['student_gender'];
    $guardianName = $_POST['guardian_name'];
    $guardianContact = $_POST['guardian_contact'];
    $level = $_POST['student_level'];
    $courseId = $_POST['course_id'];

    // Handle profile picture upload
    $profilePicturePath = null;

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../uploads/';
        $fileName = basename($_FILES['profile_picture']['name']);
        $targetFilePath = $uploadDir . $fileName;
        
        // Check if the directory exists, create it if it doesn't
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            $profilePicturePath = 'uploads/' . $fileName;
        }
    }

    // Try to update the student
    $result = $studentModel->updateStudent($studentId, $studentRfid, $firstName, $lastName, $email, $birthdate, $phone, $address, $gender, $guardianName, $guardianContact, $level, $courseId, $profilePicturePath);

    if ($result['success']) {
        $_SESSION['edit_student_success'] = true;
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
?>
