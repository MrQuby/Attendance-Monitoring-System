<?php

class Logger {
    private $pdo;
    private $lastError;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getLastError() {
        return $this->lastError;
    }

    public function logUserActivity($userId, $userType, $action) {
        try {
            error_log("Attempting to log activity - User: $userId, Type: $userType, Action: $action");
            
            $query = "INSERT INTO user_logs (admin_id, teacher_id, action, ip_address, browser_info) 
                     VALUES (:adminId, :teacherId, :action, :ipAddress, :browserInfo)";
            
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $browserInfo = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
            
            $adminId = null;
            $teacherId = null;
            
            if ($userType === 'admin') {
                $adminId = $userId;
                error_log("Setting admin_id: $adminId");
            } else {
                $teacherId = $userId;
                error_log("Setting teacher_id: $teacherId");
            }
            
            $statement = $this->pdo->prepare($query);
            
            $params = [
                ':adminId' => $adminId,
                ':teacherId' => $teacherId,
                ':action' => $action,
                ':ipAddress' => $ipAddress,
                ':browserInfo' => $browserInfo
            ];
            
            error_log("Executing query with params: " . print_r($params, true));
            
            $result = $statement->execute($params);
            
            if (!$result) {
                $error = $statement->errorInfo();
                $this->lastError = $error[2];
                error_log("Database error: " . print_r($error, true));
                return false;
            }
            
            error_log("Activity logged successfully");
            return true;
            
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log("PDO Exception: " . $e->getMessage());
            return false;
        }
    }

    public function getRecentLogs($limit = 50) {
        try {
            error_log("Attempting to retrieve recent logs");
            
            $query = "SELECT 
                        l.*,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN CONCAT(a.admin_firstname, ' ', a.admin_lastname)
                            ELSE CONCAT(t.teacher_firstname, ' ', t.teacher_lastname)
                        END as user_name,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN 'admin'
                            ELSE 'teacher'
                        END as user_type,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN l.admin_id
                            ELSE l.teacher_id
                        END as user_id
                     FROM user_logs l
                     LEFT JOIN admins a ON l.admin_id = a.admin_id
                     LEFT JOIN teachers t ON l.teacher_id = t.teacher_id
                     ORDER BY l.timestamp DESC 
                     LIMIT :limit";
            
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            
            error_log("Executing query with limit: $limit");
            
            $result = $statement->execute();
            
            if (!$result) {
                $error = $statement->errorInfo();
                $this->lastError = $error[2];
                error_log("Database error: " . print_r($error, true));
                return false;
            }
            
            error_log("Recent logs retrieved successfully");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log("PDO Exception: " . $e->getMessage());
            return false;
        }
    }

    public function getLogsByUserType($userType, $limit = 50) {
        try {
            error_log("Attempting to retrieve logs by user type: $userType");
            
            $query = "SELECT 
                        l.*,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN CONCAT(a.admin_firstname, ' ', a.admin_lastname)
                            ELSE CONCAT(t.teacher_firstname, ' ', t.teacher_lastname)
                        END as user_name,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN 'admin'
                            ELSE 'teacher'
                        END as user_type,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN l.admin_id
                            ELSE l.teacher_id
                        END as user_id
                     FROM user_logs l
                     LEFT JOIN admins a ON l.admin_id = a.admin_id
                     LEFT JOIN teachers t ON l.teacher_id = t.teacher_id
                     WHERE " . ($userType === 'admin' ? 'l.admin_id IS NOT NULL' : 'l.teacher_id IS NOT NULL') . "
                     ORDER BY l.timestamp DESC 
                     LIMIT :limit";
            
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            
            error_log("Executing query with user type: $userType and limit: $limit");
            
            $result = $statement->execute();
            
            if (!$result) {
                $error = $statement->errorInfo();
                $this->lastError = $error[2];
                error_log("Database error: " . print_r($error, true));
                return false;
            }
            
            error_log("Logs by user type retrieved successfully");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log("PDO Exception: " . $e->getMessage());
            return false;
        }
    }

    public function getLogsByDateRange($startDate, $endDate) {
        try {
            error_log("Attempting to retrieve logs by date range: $startDate - $endDate");
            
            $query = "SELECT 
                        l.*,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN CONCAT(a.admin_firstname, ' ', a.admin_lastname)
                            ELSE CONCAT(t.teacher_firstname, ' ', t.teacher_lastname)
                        END as user_name,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN 'admin'
                            ELSE 'teacher'
                        END as user_type,
                        CASE 
                            WHEN l.admin_id IS NOT NULL THEN l.admin_id
                            ELSE l.teacher_id
                        END as user_id
                     FROM user_logs l
                     LEFT JOIN admins a ON l.admin_id = a.admin_id
                     LEFT JOIN teachers t ON l.teacher_id = t.teacher_id
                     WHERE DATE(l.timestamp) BETWEEN :startDate AND :endDate 
                     ORDER BY l.timestamp DESC";
            
            $statement = $this->pdo->prepare($query);
            
            error_log("Executing query with start date: $startDate and end date: $endDate");
            
            $result = $statement->execute([
                ':startDate' => $startDate,
                ':endDate' => $endDate
            ]);
            
            if (!$result) {
                $error = $statement->errorInfo();
                $this->lastError = $error[2];
                error_log("Database error: " . print_r($error, true));
                return false;
            }
            
            error_log("Logs by date range retrieved successfully");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log("PDO Exception: " . $e->getMessage());
            return false;
        }
    }

    public function getLogsByDate($date) {
        try {
            $query = "SELECT 
                COALESCE(admin_id, teacher_id) as user_id,
                CASE 
                    WHEN admin_id IS NOT NULL THEN 'admin'
                    WHEN teacher_id IS NOT NULL THEN 'teacher'
                END as user_type,
                action,
                ip_address,
                browser_info,
                timestamp
            FROM user_logs 
            WHERE DATE(timestamp) = :date
            ORDER BY timestamp DESC";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['date' => $date]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getLogsByDate: " . $e->getMessage());
            return [];
        }
    }
}
