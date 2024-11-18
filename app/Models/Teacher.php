<?php
    class Teacher {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Method to check if teacher_id or email already exists
        public function checkExistence($teacher_id, $email) {
            $errors = [];

            $query = "SELECT * FROM teachers WHERE teacher_id = :teacher_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $errors['teacher_id'] = 'This ID Number is already registered.';
            }

            // Check if the email already exists
            $query = "SELECT * FROM teachers WHERE teacher_email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $errors['teacher_email'] = 'This email is already registered.';
            }

            return $errors;
        }

        // Register a new teacher without duplicate checks
        public function register($teacher_id, $first_name, $last_name, $email, $password) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO teachers (teacher_id, teacher_firstname, teacher_lastname, teacher_email, teacher_password) 
                    VALUES (:teacher_id, :first_name, :last_name, :email, :password)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                return ['status' => 'success', 'message' => 'Teacher registered successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to register teacher.'];
            }
        }

        // Log in a teacher
        public function login($teacher_id, $password) {
            $query = "SELECT * FROM teachers WHERE teacher_id = :teacher_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $teacher['teacher_password'])) {
                    return [
                        'status' => 'success',
                        'teacher' => [
                            'teacher_id' => $teacher['teacher_id'],
                            'teacher_firstname' => $teacher['teacher_firstname'],
                            'teacher_lastname' => $teacher['teacher_lastname'],
                            'teacher_email' => $teacher['teacher_email']
                        ]
                    ];
                } else {
                    return ['status' => 'error', 'message' => 'ID number or password is incorrect.'];
                }
            }
            return ['status' => 'error', 'message' => 'ID number or password is incorrect.'];
        }
    }
?>
