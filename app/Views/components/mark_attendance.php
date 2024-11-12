<?php
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../Models/Student.php');
    require_once(__DIR__ . '/../../Models/Attendance.php');

    header("Content-Type: application/json");
    date_default_timezone_set('Asia/Singapore'); // Ensure timezone is set

    $data = json_decode(file_get_contents("php://input"), true);
    $rfid = $data['rfid'] ?? null;
    $response = ["success" => false, "message" => "RFID not provided"];

    try {
        if ($rfid) {
            $studentModel = new Student($pdo);
            $attendanceModel = new Attendance($pdo);

            $student = $studentModel->getStudentByRfid($rfid);

            if ($student) {
                $studentId = $student['student_id'];
                $date = date("Y-m-d");
                $currentTime = date("H:i:s");

                $attendance = $attendanceModel->getTodayRecord($studentId, $date);

                if ($attendance && empty($attendance['time_out'])) {
                    $attendanceModel->recordCheckOut($attendance['attendance_id'], $currentTime);
                    $status = "OUT";
                    $time = $currentTime;
                    $attendanceDate = $attendance["date"];
                } else {
                    $attendanceModel->recordCheckIn($studentId, $date, $currentTime);
                    $status = "IN";
                    $time = $currentTime;
                    $attendanceDate = $date;
                }

                $response = [
                    "success" => true,
                    "status" => $status,
                    "time" => date("h:i A", strtotime($time)),
                    "date" => date("F d, Y", strtotime($attendanceDate)), // Format date
                    "student" => [
                        "student_id" => $student["student_id"],
                        "full_name" => $student["student_firstname"] . " " . $student["student_lastname"],
                        "department" => $student["course_id"],
                        "profile_picture" => "../../uploads/" . (basename($student["profile_picture"]) ?? "default-image.jpg")
                    ],
                    "recent_students" => array_map(function($attendance) use ($studentModel) {
                        $recentStudent = $studentModel->getStudentById($attendance["student_id"]);
                        return [
                            "student_id" => $attendance["student_id"],
                            "full_name" => $recentStudent["student_firstname"] . " " . $recentStudent["student_lastname"],
                            "date" => date("F d, Y", strtotime($attendance["date"])),
                            "time_in" => date("h:i A", strtotime($attendance["time_in"])),
                            "time_out" => $attendance["time_out"] ? date("h:i A", strtotime($attendance["time_out"])) : "N/A",
                            "status" => $attendance["time_out"] ? "OUT" : "IN",
                            "profile_picture" => "../../uploads/" . (basename($recentStudent["profile_picture"]) ?? "default-image.jpg"),
                            "department" => $recentStudent["course_id"] ?? "N/A"
                        ];
                    }, $attendanceModel->getRecentAttendance(3))
                ];
            } else {
                $response["message"] = "RFID not recognized. Student not found.";
            }
        }
    } catch (Exception $e) {
        $response = ["success" => false, "message" => "Error: " . $e->getMessage()];
    }

    echo json_encode($response);
?>
