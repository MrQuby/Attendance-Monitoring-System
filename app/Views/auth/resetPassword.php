<?php
    session_start();
    
    if (!isset($_GET['token'])) {
        header('Location: loginScreen.php');
        exit;
    }
    
    $token = $_GET['token'];
    
    $errorMessage = '';
    if (isset($_SESSION['error'])) {
        $errorMessage = $_SESSION['error'];
        unset($_SESSION['error']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            <h2><i class="fas fa-lock"></i> Set New Password</h2>
            <form method="POST" action="/../api/resetPassword.php" class="login-form" id="resetPasswordForm">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                
                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            id="password" 
                            placeholder="Enter new password" 
                            required 
                            minlength="8">
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input 
                            type="password" 
                            name="confirm_password" 
                            class="form-control" 
                            id="confirm_password" 
                            placeholder="Confirm new password" 
                            required 
                            minlength="8">
                        <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
                    </div>
                </div>

                <button type="submit" class="sign-in-button">
                    <i class="fas fa-save"></i> Reset Password
                </button>
            </form>

            <script>
                document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    var formData = new FormData(this);
                    
                    // Debug log the form data
                    console.log('Sending data:', {
                        token: formData.get('token'),
                        password: formData.get('password'),
                        confirm_password: formData.get('confirm_password')
                    });
                    
                    fetch('../../../api/resetPassword.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Server Response:', data);
                        
                        if (data.status === 'success') {
                            alert(data.message);
                            window.location.href = 'loginScreen.php';
                        } else {
                            alert(data.message);
                            console.error('Error details:', data.debug);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred: ' + error.message);
                    });
                });

                // Toggle password visibility
                document.getElementById('togglePassword').addEventListener('click', function() {
                    const password = document.getElementById('password');
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                });

                document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
                    const confirmPassword = document.getElementById('confirm_password');
                    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPassword.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                });
            </script>
        </div>
        <div class="right-side">
            <div class="welcome-message">
                <h2>Almost There!</h2>
                <p>Enter your new password to complete the reset process.</p>
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
