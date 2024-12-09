<?php
require_once(__DIR__ . '/../app/config/database.php');
require_once(__DIR__ . '/../app/Models/Logger.php');

header('Content-Type: application/json');

$logger = new Logger($pdo);
$data = json_decode(file_get_contents('php://input'), true);

$userType = $data['userType'] ?? 'all';
$filterDate = $data['filterDate'] ?? '';
$searchQuery = $data['searchQuery'] ?? '';

if (!empty($filterDate)) {
    $logs = $logger->getLogsByDate($filterDate);
} elseif ($userType !== 'all') {
    $logs = $logger->getLogsByUserType($userType);
} else {
    $logs = $logger->getRecentLogs();
}

echo json_encode($logs);
