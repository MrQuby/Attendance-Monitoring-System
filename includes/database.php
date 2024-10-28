<?php
    $host = "localhost";
    $dbname = "attendance_system";
    $username = "root";
    $password = "";

    // Establish PDO connection
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Enable exceptions for errors
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());  // Output an error message if the connection fails
    }
?>
