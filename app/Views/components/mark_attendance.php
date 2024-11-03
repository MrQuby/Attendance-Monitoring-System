<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../../Models/Student.php');
require_once(__DIR__ . '/../../Models/Attendance.php');

header("Content-Type: application/json");

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents("php://input"), true);
$rfid = $data['rfid'] ?? null;
$response = ["success" => false, "message" => "RFID not provided"];

try {
    if ($rfid) {
        // Initialize database connection and models
        $pdo = $pdo ?? (new PDO("mysql:host=localhost;dbname=attendance_system", "root", ""));
        $studentModel = new Student($pdo);
        $attendanceModel = new Attendance($pdo);

        // Find student by RFID
        $student = $studentModel->getStudentByRfid($rfid);

        if ($student) {
            $studentId = $student['student_id'];
            $date = date("Y-m-d");
            $currentTime = date("H:i:s");

            // Check if there's an existing attendance record for today without a time_out for this specific student
            $attendance = $attendanceModel->getTodayRecord($studentId, $date);

            if ($attendance && empty($attendance['time_out'])) {
                // Existing check-in found, mark as check-out
                $attendanceModel->recordCheckOut($attendance['attendance_id'], $currentTime);
                $status = "OUT";
                $time = $currentTime;
            } else {
                // No record for today or already checked out, mark as new check-in
                $attendanceModel->recordCheckIn($studentId, $date, $currentTime);
                $status = "IN";
                $time = $currentTime;
            }

            // Prepare response with student details and attendance information
            $response = [
                "success" => true,
                "status" => $status,
                "time" => $time,
                "student" => [
                    "student_id" => $student["student_id"],
                    "full_name" => $student["student_firstname"] . " " . $student["student_lastname"],
                    "department" => $student["course_id"], // Adjust as needed for department/course name
                    "profile_picture" => "../../uploads/" . (basename($student["profile_picture"]) ?? "default-image.jpg")
                ],
                // Fetch recent students with all necessary details
                "recent_students" => array_map(function($attendance) use ($studentModel) {
                    $recentStudent = $studentModel->getStudentById($attendance["student_id"]);
                    return [
                        "student_id" => $attendance["student_id"],
                        "full_name" => $recentStudent["student_firstname"] . " " . $recentStudent["student_lastname"],
                        "date" => $attendance["date"],
                        "time_in" => $attendance["time_in"],
                        "time_out" => $attendance["time_out"],
                        "status" => $attendance["time_out"] ? "OUT" : "IN",
                        "profile_picture" => "../../uploads/" . (basename($recentStudent["profile_picture"]) ?? "default-image.jpg"),
                        "department" => $recentStudent["course_id"] ?? "N/A"
                    ];
                }, $attendanceModel->getRecentAttendance(3)) // Last 3 recent records for display
            ];
        } else {
            $response["message"] = "RFID not recognized. Student not found.";
        }
    }
} catch (Exception $e) {
    // Handle exceptions and ensure response is valid JSON
    $response = ["success" => false, "message" => "Error: " . $e->getMessage()];
}

// Return the response as JSON
echo json_encode($response);
