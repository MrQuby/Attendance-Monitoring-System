<?php
    class Teacher {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Register a new teacher
        public function register($teacher_id, $first_name, $last_name, $email, $password) {
            // Check if the teacher_id or email already exists
            $query = "SELECT * FROM teachers WHERE teacher_id = :teacher_id OR teacher_email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                return ['status' => 'error', 'message' => 'Teacher ID or email already exists.'];
            }
    
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
                            'teacher_lastname' => $teacher['teacher_lastname']
                        ]
                    ];
                } else {
                    return ['status' => 'error', 'message' => 'Invalid password.'];
                }
            }

            return ['status' => 'error', 'message' => 'Teacher not found.'];
        }
    }
?>
