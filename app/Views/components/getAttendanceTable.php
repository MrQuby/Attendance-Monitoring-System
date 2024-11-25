<?php
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../Models/Student.php');

    $studentModel = new Student($pdo);
    $attendanceRecords = $studentModel->getAttendanceData();

    if (!empty($attendanceRecords)) {
        foreach ($attendanceRecords as $record) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($record['student_id']) . "</td>";
            echo "<td>";
            echo "<div class='profile-container'>";
            echo "<img src='" . (!empty($record['profile_picture']) 
                ? '/' . htmlspecialchars($record['profile_picture']) 
                : '/uploads/default.png') . "' alt='Profile Picture' class='profile-pic'>";
            echo "<span>" . htmlspecialchars($record['full_name']) . "</span>";
            echo "</div>";
            echo "</td>";
            echo "<td>" . date("F d, Y", strtotime($record['date'])) . "</td>";
            echo "<td style='color: " . (!empty($record['time_in']) ? "green" : "gray") . ";'>";
            echo !empty($record['time_in']) ? date("h:i A", strtotime($record['time_in'])) : "N/A";
            echo "</td>";
            echo "<td style='color: " . (!empty($record['time_out']) ? "red" : "gray") . ";'>";
            echo !empty($record['time_out']) ? date("h:i A", strtotime($record['time_out'])) : "N/A";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No attendance records found.</td></tr>";
    }
