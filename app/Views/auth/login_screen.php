<?php
    session_start();

    $errorMessage = '';
    if (isset($_SESSION['response'])) {
        $response = json_decode($_SESSION['response'], true);
        if ($response['status'] === 'error') {
            $errorMessage = $response['message'];
        }
        unset($_SESSION['response']);
    }

    // Generate CSRF token for form submission
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container-login">
        <div class="left-side">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2><i class="fas fa-user-lock"></i> LOGIN ACCOUNT</h2>
            <form method="POST" action="api/login.php" class="login-form">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="form-group">
                    <label for="idNumber">ID Number</label>
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="teacher_id" class="form-control" id="idNumber" placeholder="SCC-123456" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="teacher_password" class="form-control" id="password"
                            placeholder="Enter your password" required minlength="8">
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <div class="form-footer">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div>
                </div>
                <button type="submit" class="sign-in-button">
                    <i class="fas fa-sign-in-alt"></i> SIGN IN
                </button>
                <?php if ($errorMessage): ?>
                    <div style="color: red; margin-top: 10px;">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                    <div class="signup-link">
                        Don't have an account? <a href="/../app/Views/auth/signup_screen.php">Sign up</a>
                    </div>
                <div class="error-message"></div>
            </form>
        </div>
        <div class="right-side">
            <div class="welcome-message">
                <h2>Welcome Back!</h2>
                <p>Sign in to access the Attendance Monitoring System</p>
                <div class="decoration">
                    <i class="fas fa-clipboard-check"></i>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function (e) {
            const button = this.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
        });
    </script>
</body>
</html>