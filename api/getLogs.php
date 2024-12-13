<?php
require_once(__DIR__ . '/../app/config/database.php');
require_once(__DIR__ . '/../app/Models/Logger.php');

header('Content-Type: application/json');

$logger = new Logger($pdo);
$data = json_decode(file_get_contents('php://input'), true);

$userType = $data['userType'] ?? 'all';
$startDate = $data['startDate'] ?? '';
$endDate = $data['endDate'] ?? '';

if (!empty($startDate) && !empty($endDate)) {
    $logs = $logger->getLogsByDateRange($startDate, $endDate);
} elseif ($userType !== 'all') {
    $logs = $logger->getLogsByUserType($userType);
} else {
    $logs = $logger->getRecentLogs();
}

echo json_encode($logs);
