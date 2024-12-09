<?php
require_once(__DIR__ . '/../app/config/database.php');
require_once(__DIR__ . '/../app/Models/Teacher.php');
require_once(__DIR__ . '/../app/Models/Admin.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = $_POST['email'] ?? '';
        $response = ['status' => 'error', 'message' => '', 'debug' => []];
        
        if (empty($email)) {
            $response['message'] = "Email is required.";
            echo json_encode($response);
            exit;
        }
        
        $teacher = new Teacher($pdo);
        $admin = new Admin($pdo);
        
        // Check if email exists in either table
        $teacherData = $teacher->findByEmail($email);
        $adminData = $admin->findByEmail($email);
        
        error_log("Email search results - " . json_encode([
            'email' => $email,
            'teacher_found' => !empty($teacherData),
            'admin_found' => !empty($adminData)
        ]));
        
        if (!$teacherData && !$adminData) {
            $response['message'] = "Email not found.";
            echo json_encode($response);
            exit;
        }
        
        // Generate token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        error_log("Generated reset token - " . json_encode([
            'token' => $token,
            'expiry' => $expiry
        ]));
        
        // Store token in appropriate table
        $tokenStored = false;
        if ($teacherData) {
            $tokenStored = $teacher->storeResetToken($email, $token, $expiry);
            error_log("Teacher token store attempt - Result: " . ($tokenStored ? "success" : "failed"));
        } else {
            $tokenStored = $admin->storeResetToken($email, $token, $expiry);
            error_log("Admin token store attempt - Result: " . ($tokenStored ? "success" : "failed"));
        }
        
        if (!$tokenStored) {
            $response['message'] = "Failed to generate reset token.";
            echo json_encode($response);
            exit;
        }
        
        // Generate reset URL
        $resetUrl = "http://localhost/RFID-gate-attendance/app/Views/auth/resetPassword.php?token=" . $token;
        
        // Send email with reset link
        require_once(__DIR__ . '/../vendor/autoload.php');
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alvinlag94@gmail.com'; // Your Gmail
            $mail->Password = 'nzys quoo kqem hssr'; // Your app password
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            $mail->setFrom('alvinlag94@gmail.com', 'RFID Gate Attendance');
            $mail->addAddress($email);
            
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the following link to reset your password: <a href='$resetUrl'>Reset Password</a>";
            $mail->AltBody = "Click the following link to reset your password: $resetUrl";
            
            $mail->send();
            
            $response['status'] = 'success';
            $response['message'] = "Password reset instructions have been sent to your email.";
            $response['debug']['reset_url'] = $resetUrl;
            
        } catch (Exception $e) {
            error_log("Email send error: " . $e->getMessage());
            $response['message'] = "Failed to send reset email.";
            $response['debug']['email_error'] = $e->getMessage();
        }
        
        echo json_encode($response);
        
    } catch (Exception $e) {
        error_log("Password reset request error: " . $e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => 'An unexpected error occurred.',
            'debug' => ['error' => $e->getMessage()]
        ]);
    }
    exit;
}
?>
