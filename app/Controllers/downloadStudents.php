<?php
require_once(__DIR__ . '/../Models/SessionManager.php');
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../Models/Student.php');

SessionManager::startSession();
if (!SessionManager::isAdminLoggedIn()) {
    die('Unauthorized access');
}

$type = isset($_GET['type']) ? $_GET['type'] : 'template';
$studentModel = new Student($pdo);

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . ($type === 'template' ? 'students_template.csv' : 'students_export.csv') . '"');

// Create output handle
$output = fopen('php://output', 'w');

// Write headers
$headers = [
    'student_id',
    'student_firstname',
    'student_lastname',
    'student_email',
    'student_birthdate',
    'student_phone',
    'student_address',
    'student_gender',
    'guardian_name',
    'guardian_contact',
    'student_level',
    'course_id',
    'student_rfid'
];
fputcsv($output, $headers);

if ($type === 'export') {
    // Get all students with complete data including course information
    $query = "SELECT 
        s.student_id,
        s.student_firstname,
        s.student_lastname,
        s.student_email,
        s.student_birthdate,
        s.student_phone,
        s.student_address,
        s.student_gender,
        s.guardian_name,
        s.guardian_contact,
        s.student_level,
        s.course_id,
        s.student_rfid
    FROM students s
    LEFT JOIN courses c ON s.course_id = c.course_id
    WHERE s.deleted = FALSE
    ORDER BY s.student_id";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Write student data
    foreach ($students as $student) {
        $row = [
            $student['student_id'],
            $student['student_firstname'],
            $student['student_lastname'],
            $student['student_email'],
            $student['student_birthdate'],
            $student['student_phone'],
            $student['student_address'],
            $student['student_gender'],
            $student['guardian_name'],
            $student['guardian_contact'],
            $student['student_level'],
            $student['course_id'],
            $student['student_rfid']
        ];
        fputcsv($output, $row);
    }
} else {
    // For template, write one example row
    $exampleRow = [
        '2024001', // student_id
        'John', // firstname
        'Doe', // lastname
        'john.doe@example.com', // email
        '2000-01-01', // birthdate
        '1234567890', // phone
        '123 Main St', // address
        'Male', // gender
        'Jane Doe', // guardian name
        '0987654321', // guardian contact
        '1st Year', // level
        'BSIT', // course_id
        'RF123456' // rfid
    ];
    fputcsv($output, $exampleRow);
}

fclose($output);
exit;
