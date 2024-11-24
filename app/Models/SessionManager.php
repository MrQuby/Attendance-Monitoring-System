<?php
class SessionManager {

    // Start the session
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Store teacher info in session
    public static function loginTeacher($teacher) {
        self::startSession();

        $_SESSION['teacher_id'] = $teacher['teacher_id'];
        $_SESSION['teacher_firstname'] = $teacher['teacher_firstname'];
        $_SESSION['teacher_lastname'] = $teacher['teacher_lastname'];

        if (isset($teacher['teacher_email'])) {
            $_SESSION['teacher_email'] = $teacher['teacher_email'];
        }
        if (isset($teacher['registered_at'])) {
            $_SESSION['registered_at'] = $teacher['registered_at'];
        }
    }

    // Store admin info in session
    public static function loginAdmin($admin) {
        self::startSession();

        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['admin_firstname'] = $admin['admin_firstname'];
        $_SESSION['admin_lastname'] = $admin['admin_lastname'];

        if (isset($admin['admin_email'])) {
            $_SESSION['admin_email'] = $admin['admin_email'];
        }
        if (isset($admin['registered_at'])) {
            $_SESSION['registered_at'] = $admin['registered_at'];
        }
    }

    // Check if a teacher is logged in
    public static function isTeacherLoggedIn() {
        return isset($_SESSION['teacher_id']);
    }

    // Check if an admin is logged in
    public static function isAdminLoggedIn() {
        return isset($_SESSION['admin_id']);
    }

    // Get the logged-in teacher info
    public static function getTeacherInfo() {
        if (self::isTeacherLoggedIn()) {
            return [
                'teacher_id' => $_SESSION['teacher_id'],
                'teacher_firstname' => $_SESSION['teacher_firstname'],
                'teacher_lastname' => $_SESSION['teacher_lastname'],
                'teacher_email' => $_SESSION['teacher_email'] ?? null,
                'registered_at' => $_SESSION['registered_at'] ?? null,
            ];
        }
        return null;
    }

    // Get the logged-in admin info
    public static function getAdminInfo() {
        if (self::isAdminLoggedIn()) {
            return [
                'admin_id' => $_SESSION['admin_id'],
                'admin_firstname' => $_SESSION['admin_firstname'],
                'admin_lastname' => $_SESSION['admin_lastname'],
                'admin_email' => $_SESSION['admin_email'] ?? null,
                'registered_at' => $_SESSION['registered_at'] ?? null,
            ];
        }
        return null;
    }

    // Logout the teacher
    public static function logoutTeacher() {
        self::startSession();
        unset(
            $_SESSION['teacher_id'],
            $_SESSION['teacher_firstname'],
            $_SESSION['teacher_lastname'],
            $_SESSION['teacher_email'],
            $_SESSION['registered_at']
        );
    }

    // Logout the admin
    public static function logoutAdmin() {
        self::startSession();
        unset(
            $_SESSION['admin_id'],
            $_SESSION['admin_firstname'],
            $_SESSION['admin_lastname'],
            $_SESSION['admin_email'],
            $_SESSION['registered_at']
        );
    }

    // Destroy the session completely
    public static function destroySession() {
        self::startSession();
        session_unset();
        session_destroy();
        $_SESSION = [];
    }
}
?>
