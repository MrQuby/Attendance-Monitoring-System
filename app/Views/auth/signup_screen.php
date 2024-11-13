<?php
    session_start();

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    $successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : null;
    unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="/../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/../assets/css/bootstrap.min.css">
</head>
<body>
    <!-- Success Modals -->
    <?php if ($successMessage): ?>
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"><?php echo $successMessage; ?></div>
                    <div class="modal-footer">
                        <a href="login_screen.php" class="btn btn-primary">Go to Login</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container-login">
        <div class="left-side">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2><i class="fas fa-user-plus"></i> CREATE ACCOUNT</h2>
            <form method="POST" action="/../api/signup.php" class="signup-form">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <!-- Form fields -->
                <div class="name-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="teacher_firstname" class="form-control" id="firstName" placeholder="First name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="teacher_lastname" class="form-control" id="lastName" placeholder="Last name" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="idNumber">ID Number</label>
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="teacher_id" class="form-control" id="idNumber" placeholder="SCC-123456" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="teacher_email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="teacher_password" class="form-control" id="password" placeholder="Create password" required minlength="8">
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="teacher_confirm_password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
                        <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
                    </div>
                </div>
                <button type="submit" class="sign-in-button">
                    <i class="fas fa-user-plus"></i> SIGN UP
                </button>
                <div class="signup-link">
                    Already have an account? <a href="../../../index.php">Sign in</a>
                </div>
            </form>
        </div>
        <div class="right-side">
            <div class="welcome-message">
                <h2>Join Us!</h2>
                <p>Create an account to start managing attendance efficiently</p>
                <div class="decoration">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS for Modal -->
    <script src="/../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($successMessage): ?>
            // Display the success modal when there's a success message
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        <?php endif; ?>

        // Password toggle script
        ['togglePassword', 'toggleConfirmPassword'].forEach(id => {
            document.getElementById(id).addEventListener('click', function () {
                const field = this.previousElementSibling;
                const isPassword = field.type === 'password';
                field.type = isPassword ? 'text' : 'password';
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>
