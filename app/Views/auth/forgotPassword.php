<?php
    session_start();
    
    $errorMessage = '';
    if (isset($_SESSION['error'])) {
        $errorMessage = $_SESSION['error'];
        unset($_SESSION['error']);
    }
    
    $successMessage = '';
    if (isset($_SESSION['success'])) {
        $successMessage = $_SESSION['success'];
        unset($_SESSION['success']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            <h2><i class="fas fa-key"></i> Reset Password</h2>
            <form method="POST" action="/../api/forgotPassword.php" class="login-form">
                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($successMessage): ?>
                    <div class="alert alert-success">
                        <?php echo $successMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            id="email" 
                            placeholder="Enter your email address" 
                            required>
                    </div>
                </div>

                <button type="submit" class="sign-in-button">
                    <i class="fas fa-paper-plane"></i> Send Reset Link
                </button>

                <div class="back-to-login">
                    <a href="loginScreen.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
                </div>
            </form>
        </div>
        <div class="right-side">
            <div class="welcome-message">
                <h2>Password Reset</h2>
                <p>Enter your email address and we'll send you a link to reset your password.</p>
                <div class="decoration">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
