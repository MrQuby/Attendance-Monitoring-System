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
    }