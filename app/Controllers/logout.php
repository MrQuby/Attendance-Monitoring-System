<?php
    require_once(__DIR__ . '/../Models/SessionManager.php');
    require_once(__DIR__ . '/../config/database.php');
    require_once(__DIR__ . '/../Models/Logger.php');

    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Get database connection
    global $pdo;
    if (!isset($pdo)) {
        require_once(__DIR__ . '/../config/database.php');
    }

    // Initialize logger
    $logger = new Logger($pdo);

    // Log the logout activity before destroying the session
    if (isset($_SESSION['user_type'])) {
        $userId = null;
        $userType = null;
        
        if ($_SESSION['user_type'] === 'admin' && isset($_SESSION['admin']['admin_id'])) {
            $userId = $_SESSION['admin']['admin_id'];
            $userType = 'admin';
        } elseif ($_SESSION['user_type'] === 'teacher' && isset($_SESSION['teacher']['teacher_id'])) {
            $userId = $_SESSION['teacher']['teacher_id'];
            $userType = 'teacher';
        }
        
        if ($userId !== null && $userType !== null) {
            try {
                $result = $logger->logUserActivity($userId, $userType, 'logout');
                if (!$result) {
                    error_log("Failed to log logout activity for $userType ID: $userId");
                }
            } catch (Exception $e) {
                error_log("Exception while logging logout: " . $e->getMessage());
            }
        }
    }

    // Clear session data
    if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_firstname']);
        unset($_SESSION['admin_lastname']);
    }
    if (isset($_SESSION['teacher'])) {
        unset($_SESSION['teacher']);
        unset($_SESSION['teacher_id']);
        unset($_SESSION['teacher_firstname']);
        unset($_SESSION['teacher_lastname']);
    }
    unset($_SESSION['user_type']);

    // Destroy session
    session_destroy();
?>

<script>
    localStorage.removeItem('activeLink');
    window.location.href = '../../index.php?logout=success';
</script>