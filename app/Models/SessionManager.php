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
            $_SESSION['teacher_id'] = $teacher['teacher_id'];
            $_SESSION['teacher_first_name'] = $teacher['teacher_first_name'];
            $_SESSION['teacher_last_name'] = $teacher['teacher_last_name'];
        }

        // Check if a teacher is logged in
        public static function isTeacherLoggedIn() {
            return isset($_SESSION['teacher_id']);
        }

        // Get the logged-in teacher info
        public static function getTeacherInfo() {
            if (self::isTeacherLoggedIn()) {
                return [
                    'teacher_id' => $_SESSION['teacher_id'],
                    'teacher_first_name' => $_SESSION['teacher_first_name'],
                    'teacher_last_name' => $_SESSION['teacher_last_name']
                ];
            }
            return null;
        }

        // Logout the teacher
        public static function logoutTeacher() {
            session_start();
            $_SESSION = [];
            session_destroy();
        }
    }
?>