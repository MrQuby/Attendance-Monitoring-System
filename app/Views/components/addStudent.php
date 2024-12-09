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
    $defaultImagePath = '../../../uploads/pp.png';

    // Handle profile picture upload
    $profilePicturePath = $defaultImagePath;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = uniqid() . '-' . basename($_FILES['profile_picture']['name']);
        $uploadDir = __DIR__ . '/../../../uploads/';
        $destPath = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $profilePicturePath = 'uploads/' . $fileName;
        }
    }

    // Try to add the student
    $result = $studentModel->addStudent($studentId, $firstName, $lastName, $email, $birthdate, $phone, $address, $gender, $guardianName, $guardianContact, $level, $courseId, $profilePicturePath, $studentRfid);

    if ($result['success']) {
        $_SESSION['add_student_success'] = true;
        header('Location: ../../Controllers/adminDashboard.php?section=student-list');
    } else {
        // Store the error and form data in session
        $_SESSION['add_student_error'] = $result['error'];
        $_SESSION['add_student_form_data'] = $_POST;
        
        // Redirect back with error flag
        header('Location: ../../Controllers/adminDashboard.php?section=student-list&show_add_modal=1');
    }
    exit;
?>
