<?php
    class Teacher {
        private $pdo;

        // Constructor to initialize the PDO instance (database connection)
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Register a new teacher
        public function register($teacher_id, $first_name, $last_name, $password) {
            // Check if the teacher_id already exists
            $query = "SELECT * FROM teachers WHERE teacher_id = :teacher_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return ['status' => 'error', 'message' => 'Teacher ID already exists.'];
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new teacher into the database
            $query = "INSERT INTO teachers (teacher_id, teacher_first_name, teacher_last_name, teacher_password) 
                    VALUES (:teacher_id, :first_name, :last_name, :password)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':teacher_id', $teacher_id);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
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

                // Verify the hashed password
                if (password_verify($password, $teacher['teacher_password'])) {
                    return [
                        'status' => 'success',
                        'teacher' => [
                            'teacher_id' => $teacher['teacher_id'],
                            'teacher_first_name' => $teacher['teacher_first_name'],
                            'teacher_last_name' => $teacher['teacher_last_name']
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
