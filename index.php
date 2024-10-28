<?php
session_start();

// Check if there's an error message or success message to display
$errorMessage = '';
if (isset($_SESSION['response'])) {
    $response = json_decode($_SESSION['response'], true); // Decode JSON response
    if ($response['status'] === 'error') {
        $errorMessage = $response['message']; // Set error message
    }
    unset($_SESSION['response']);  // Clear the message after displaying
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
    <title>Student Attendance Monitoring System</title>
    <link rel="stylesheet" href="assets/css/styles.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-login">
        <div class="left-side">
            <h2>LOGIN ACCOUNT</h2>
            <form method="POST" action="api/login.php">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="form-group">
                    <label for="idNumber">ID Number</label>
                    <input type="text" name="teacher_id" class="form-control" id="idNumber" placeholder="SCC-123456" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="teacher_password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <input type="checkbox" id="show-password"> Show Password
                <div class="forgot-password">
                    <a href="#">Forgot Your Password?</a>
                </div>
                <button type="submit" class="sign-in-button">SIGN IN</button>
                <?php if ($errorMessage): ?>
                    <div style="color: red; margin-top: 10px;"><?php echo $errorMessage; ?></div>
                <?php endif; ?>
            </form>
        </div>
        <div class="right-side">
            <div class="welcome-message">
                <h2>Welcome Back</h2>
                <p>Sign in to access the Attendance Monitoring System.</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
