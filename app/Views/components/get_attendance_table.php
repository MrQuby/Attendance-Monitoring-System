<?php
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../Models/Student.php');

    $studentModel = new Student($pdo);
    $attendanceRecords = $studentModel->getAttendanceData();

    if (!empty($attendanceRecords)) {
        foreach ($attendanceRecords as $record) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($record['student_id']) . "</td>";
            echo "<td>" . htmlspecialchars($record['full_name']) . "</td>";
            echo "<td>" . date("h:i A", strtotime($record['time_in'])) . "</td>";
            echo "<td>" . (!empty($record['time_out']) ? date("h:i A", strtotime($record['time_out'])) : 'N/A') . "</td>";
            echo "<td>" . date("F d, Y", strtotime($record['date'])) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No attendance records found.</td></tr>";
    }
