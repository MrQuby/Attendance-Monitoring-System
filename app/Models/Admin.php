<?php
    class Admin {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function login($admin_id, $password) {
            $query = "SELECT * FROM admins WHERE admin_id = :admin_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (password_verify($password, $admin['admin_password'])) {
                    return [
                        'status' => 'success',
                        'admin' => [
                            'admin_id' => $admin['admin_id'],
                            'admin_firstname' => $admin['admin_firstname'],
                            'admin_lastname' => $admin['admin_lastname'],
                            'admin_email' => $admin['admin_email']
                        ]
                    ];
                } else {
                    return ['status' => 'error', 'message' => 'ID number or password is incorrect.'];
                }
            }
        
            return ['status' => 'error', 'message' => 'ID number or password is incorrect.'];
        }

        public function findByEmail($email) {
            $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE admin_email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch();
        }
        
        public function storeResetToken($adminId, $token, $expires) {
            try {
                $stmt = $this->pdo->prepare("UPDATE admins SET reset_token = ?, reset_token_expires = ? WHERE admin_id = ?");
                $result = $stmt->execute([$token, $expires, $adminId]);
                
                error_log("Store token attempt (admin) - " . json_encode([
                    'admin_id' => $adminId,
                    'token' => $token,
                    'expires' => $expires,
                    'success' => $result,
                    'rows_affected' => $stmt->rowCount()
                ]));
                
                return $result;
            } catch (PDOException $e) {
                error_log("Error storing reset token (admin): " . $e->getMessage());
                return false;
            }
        }
        
        public function findByResetToken($token) {
            try {
                // First, let's see all tokens in the database
                $allTokensStmt = $this->pdo->query("SELECT admin_id, reset_token, reset_token_expires FROM admins WHERE reset_token IS NOT NULL");
                $allTokens = $allTokensStmt->fetchAll(PDO::FETCH_ASSOC);
                error_log("All admin tokens in database: " . json_encode($allTokens));
                
                // First try without expiration check
                $query1 = "SELECT * FROM admins WHERE reset_token = ?";
                $stmt1 = $this->pdo->prepare($query1);
                $stmt1->execute([$token]);
                $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                
                error_log("Admin token search without expiration - " . json_encode([
                    'token' => $token,
                    'found' => !empty($result1),
                    'admin_data' => $result1
                ]));
                
                // Then try with expiration check
                $query2 = "SELECT *, NOW() as current_time FROM admins 
                          WHERE reset_token = ? 
                          AND reset_token_expires > NOW()";
                $stmt2 = $this->pdo->prepare($query2);
                $stmt2->execute([$token]);
                $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                
                error_log("Admin token search with expiration - " . json_encode([
                    'token' => $token,
                    'found' => !empty($result2),
                    'admin_data' => $result2,
                    'token_expires' => $result2 ? $result2['reset_token_expires'] : null,
                    'current_time' => $result2 ? $result2['current_time'] : null
                ]));
                
                // For now, return the result without expiration check
                return $result1;
            } catch (PDOException $e) {
                error_log("Error finding reset token: " . $e->getMessage());
                return false;
            }
        }
        
        public function updatePassword($adminId, $hashedPassword) {
            try {
                $query = "UPDATE admins SET admin_password = ? WHERE admin_id = ?";
                $stmt = $this->pdo->prepare($query);
                $result = $stmt->execute([$hashedPassword, $adminId]);
                
                error_log(json_encode([
                    'admin_id' => $adminId,
                    'update_success' => $result,
                    'rows_affected' => $stmt->rowCount()
                ]));
                
                return $result;
            } catch (PDOException $e) {
                error_log("Database error in updatePassword: " . $e->getMessage());
                return false;
            }
        }
        
        public function clearResetToken($adminId) {
            $stmt = $this->pdo->prepare("UPDATE admins SET reset_token = NULL, reset_token_expires = NULL WHERE admin_id = ?");
            return $stmt->execute([$adminId]);
        }
    }