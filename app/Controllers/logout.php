<?php
    require_once(__DIR__ . '/../Models/SessionManager.php');

    SessionManager::startSession();

    if (SessionManager::isTeacherLoggedIn()) {
        SessionManager::logoutTeacher();
    } elseif (SessionManager::isAdminLoggedIn()) {
        SessionManager::logoutAdmin();
    }

    SessionManager::destroySession();
?>

<script>
    localStorage.removeItem('activeLink');
    window.location.href = '../../app/Views/auth/login_screen.php';
</script>