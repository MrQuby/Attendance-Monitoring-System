<?php

require_once(__DIR__ . '/../../config/database.php');

try {
    // Query to get the recent attendance data with student information
    $query = "
        SELECT 
            a.student_id,
            CONCAT(s.student_firstname, ' ', s.student_lastname) AS full_name,
            a.time_in,
            a.time_out,
            DATE(a.time_in) AS date
        FROM attendance a
        JOIN students s ON a.student_id = s.student_id
        ORDER BY a.time_in DESC
        LIMIT 50"; // Adjust the limit if necessary

    $statement = $pdo->prepare($query);
    $statement->execute();

    // Fetch the data and format it as an associative array
    $attendanceRecords = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Return the data in JSON format
    echo json_encode([
        'success' => true,
        'data' => $attendanceRecords
    ]);
} catch (PDOException $e) {
    // Handle any database errors
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching attendance data: ' . $e->getMessage()
    ]);
}
?>
