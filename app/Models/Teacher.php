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

        public function getAllTeachers($filterTeacherId = null) {
            $query = "SELECT * FROM teachers";
            $conditions = [];
            $params = [];
        
            if ($filterTeacherId) {
                $conditions[] = "teacher_id LIKE :teacher_id";
                $params[':teacher_id'] = "%{$filterTeacherId}%";
            }
        
            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }
        
            $stmt = $this->pdo->prepare($query);
            
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countTotalTeachers() {
            $query = "SELECT COUNT(*) as total_teachers FROM teachers";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_teachers'];
        }

        public function findByEmail($email) {
            $stmt = $this->pdo->prepare("SELECT * FROM teachers WHERE teacher_email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch();
        }
        
        public function storeResetToken($email, $token, $expiry) {
            try {
                // First verify the teacher exists
                $verifyQuery = "SELECT teacher_id, teacher_email FROM teachers WHERE teacher_email = ?";
                $verifyStmt = $this->pdo->prepare($verifyQuery);
                $verifyStmt->execute([$email]);
                $teacher = $verifyStmt->fetch(PDO::FETCH_ASSOC);
                
                error_log("STORE TOKEN - Teacher verification: " . json_encode([
                    'email' => $email,
                    'teacher_found' => !empty($teacher),
                    'teacher_data' => $teacher
                ]));
                
                if (!$teacher) {
                    error_log("Teacher not found for email: " . $email);
                    return false;
                }
                
                // Store the token
                $query = "UPDATE teachers SET reset_token = ?, reset_token_expires = ? WHERE teacher_email = ?";
                $stmt = $this->pdo->prepare($query);
                $success = $stmt->execute([$token, $expiry, $email]);
                
                error_log("STORE TOKEN - Update result: " . json_encode([
                    'success' => $success,
                    'token' => $token,
                    'expiry' => $expiry,
                    'rows_affected' => $stmt->rowCount()
                ]));
                
                // Verify the token was stored
                if ($success) {
                    $verifyStoreQuery = "SELECT reset_token, reset_token_expires FROM teachers WHERE teacher_email = ?";
                    $verifyStoreStmt = $this->pdo->prepare($verifyStoreQuery);
                    $verifyStoreStmt->execute([$email]);
                    $storedData = $verifyStoreStmt->fetch(PDO::FETCH_ASSOC);
                    
                    error_log("STORE TOKEN - Verification: " . json_encode([
                        'stored_token' => $storedData['reset_token'],
                        'stored_expiry' => $storedData['reset_token_expires'],
                        'matches_original' => $storedData['reset_token'] === $token
                    ]));
                }
                
                return $success;
            } catch (PDOException $e) {
                error_log("Error storing reset token: " . $e->getMessage());
                return false;
            }
        }
        
        public function findByResetToken($token) {
            try {
                // First, dump ALL teachers with their tokens
                $allTeachers = $this->pdo->query("SELECT teacher_id, teacher_email, reset_token, reset_token_expires FROM teachers")->fetchAll(PDO::FETCH_ASSOC);
                error_log("ALL TEACHERS IN DATABASE: " . json_encode($allTeachers));
                
                // Now check for the specific token
                $query = "SELECT * FROM teachers WHERE reset_token = ?";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$token]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                error_log("EXACT TOKEN SEARCH: " . json_encode([
                    'searching_for' => $token,
                    'found_teacher' => $result ? 'yes' : 'no',
                    'found_data' => $result
                ]));
                
                return $result;
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }
        
        public function updatePassword($teacherId, $hashedPassword) {
            try {
                $query = "UPDATE teachers SET teacher_password = ? WHERE teacher_id = ?";
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute([$hashedPassword, $teacherId]);
                
                error_log(json_encode([
                    'teacher_id' => $teacherId,
                    'update_success' => $result,
                    'rows_affected' => $stmt->rowCount()
                ]));
                
                return $result;
            } catch (PDOException $e) {
                error_log("Database error in updatePassword: " . $e->getMessage());
                return false;
            }
        }
        
        public function clearResetToken($teacherId) {
            $stmt = $this->pdo->prepare("UPDATE teachers SET reset_token = NULL, reset_token_expires = NULL WHERE teacher_id = ?");
            return $stmt->execute([$teacherId]);
        }
    }
?>
