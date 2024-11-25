<?php
    session_start();

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    $successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : null;
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
    $input_data = isset($_SESSION['input_data']) ? $_SESSION['input_data'] : [];

    $validation_error = isset($_SESSION['validation_error']);
    unset($_SESSION['validation_error']);
    
    if (!$validation_error && !$successMessage) {
        unset($_SESSION['input_data'], $_SESSION['errors']);
    }

    unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
            <h2><i class="fas fa-user-plus"></i> CREATE ACCOUNT</h2>
            <form method="POST" action="/../api/signup.php" class="signup-form">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="name-row">
                    <!-- First Name -->
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="teacher_firstname" class="form-control <?php echo isset($errors['teacher_firstname']) ? 'input-error' : ''; ?>" id="firstName" placeholder="First name" value="<?php echo htmlspecialchars($input_data['teacher_firstname'] ?? '', ENT_QUOTES); ?>" required>
                        </div>
                        <?php if (isset($errors['teacher_firstname'])): ?>
                            <p class="error-message"><?php echo $errors['teacher_firstname']; ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="teacher_lastname" class="form-control <?php echo isset($errors['teacher_lastname']) ? 'input-error' : ''; ?>" id="lastName" placeholder="Last name" value="<?php echo htmlspecialchars($input_data['teacher_lastname'] ?? '', ENT_QUOTES); ?>" required>
                        </div>
                        <?php if (isset($errors['teacher_lastname'])): ?>
                            <p class="error-message"><?php echo $errors['teacher_lastname']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ID Number -->
                <div class="form-group">
                    <label for="idNumber">ID Number</label>
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="teacher_id" class="form-control <?php echo isset($errors['teacher_id']) ? 'input-error' : ''; ?>" id="idNumber" placeholder="SCC-123456" value="<?php echo htmlspecialchars($input_data['teacher_id'] ?? '', ENT_QUOTES); ?>" required>
                    </div>
                    <?php if (isset($errors['teacher_id'])): ?>
                        <p class="error-message"><?php echo $errors['teacher_id']; ?></p>
                    <?php endif; ?>
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="teacher_email" class="form-control <?php echo isset($errors['teacher_email']) ? 'input-error' : ''; ?>" id="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($input_data['teacher_email'] ?? '', ENT_QUOTES); ?>" required>
                    </div>
                    <?php if (isset($errors['teacher_email'])): ?>
                        <p class="error-message"><?php echo $errors['teacher_email']; ?></p>
                    <?php endif; ?>
                </div>
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="teacher_password" class="form-control <?php echo isset($errors['teacher_password']) ? 'input-error' : ''; ?>" id="password" placeholder="Create password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                    <?php if (isset($errors['teacher_password'])): ?>
                        <?php foreach (explode('. ', $errors['teacher_password']) as $error): ?>
                            <?php if (!empty($error)): ?>
                                <p class="error-message"><?php echo $error; ?>.</p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="teacher_confirm_password" class="form-control <?php echo isset($errors['teacher_confirm_password']) ? 'input-error' : ''; ?>" id="confirmPassword" placeholder="Confirm password" required>
                        <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
                    </div>
                    <?php if (isset($errors['teacher_confirm_password'])): ?>
                        <p class="error-message"><?php echo $errors['teacher_confirm_password']; ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="sign-in-button">
                    <i class="fas fa-user-plus"></i> SIGN UP
                </button>
                <div class="signup-link">
                    Already have an account? <a href="loginScreen.php">Sign in</a>
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
    <!-- Success Modal -->
    <?php if ($successMessage): ?>
        <?php include __DIR__ . '/../modals/signupSuccessModal.php'; ?>
    <?php endif; ?>
    <!-- JS -->
    <script src="/../assets/js/bootstrap.bundle.min.js"></script>
    <script src="/../assets/js/togglePassword.js"></script>
    <script>
        <?php if ($successMessage): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
