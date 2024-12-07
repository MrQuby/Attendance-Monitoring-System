<?php
    class Student {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Method to fetch all students, with optional filtering by student ID or RFID
        public function getAllStudents($studentId = null, $studentRfid = null) {
            $query = "SELECT students.student_id, students.student_firstname, students.student_lastname, 
                            students.student_email, students.student_level, students.student_rfid, students.profile_picture,
                            courses.course_id, courses.course_name 
                    FROM students 
                    LEFT JOIN courses ON students.course_id = courses.course_id
                    WHERE students.deleted = FALSE";
        
            // Add WHERE clause if filtering by student ID or RFID
            if ($studentId) {
                $query .= " AND students.student_id LIKE :studentId";
            }
            if ($studentRfid) {
                $query .= " AND students.student_rfid LIKE :studentRfid";
            }
        
            $statement = $this->pdo->prepare($query);
        
            // Bind the student ID and/or RFID if provided
            if ($studentId) {
                $searchTerm = '%' . $studentId . '%';
                $statement->bindParam(':studentId', $searchTerm);
            }
            if ($studentRfid) {
                $searchTerm = '%' . $studentRfid . '%';
                $statement->bindParam(':studentRfid', $searchTerm);
            }
        
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        // Method to add a student with manually inputted student_id and student_rfid
        public function addStudent($studentId, $firstName, $lastName, $email, $birthdate, $phone, $address, $gender, $guardianName, $guardianContact, $level, $courseId, $profilePicturePath, $studentRfid) {
            $query = "INSERT INTO students (student_id, student_firstname, student_lastname, student_email, student_birthdate, 
                                            student_phone, student_address, student_gender, guardian_name, guardian_contact, 
                                            student_level, course_id, profile_picture, student_rfid) 
                    VALUES (:studentId, :firstName, :lastName, :email, :birthdate, :phone, :address, :gender, :guardianName, 
                            :guardianContact, :level, :courseId, :profilePicturePath, :studentRfid)";
                    
            $statement = $this->pdo->prepare($query);

            $statement->bindParam(':studentId', $studentId);
            $statement->bindParam(':firstName', $firstName);
            $statement->bindParam(':lastName', $lastName);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':birthdate', $birthdate);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':address', $address);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':guardianName', $guardianName);
            $statement->bindParam(':guardianContact', $guardianContact);
            $statement->bindParam(':level', $level);
            $statement->bindParam(':courseId', $courseId);
            $statement->bindParam(':profilePicturePath', $profilePicturePath);
            $statement->bindParam(':studentRfid', $studentRfid);

            $statement->execute();
        }

        // Get a student by ID
        public function getStudentById($studentId) {
            $query = "SELECT student_id, student_firstname, student_lastname, student_email, student_birthdate, 
                            student_phone, student_address, student_gender, guardian_name, guardian_contact, 
                            student_level, course_id, profile_picture, student_rfid
                    FROM students 
                    WHERE student_id = :studentId";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':studentId', $studentId);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        // Method to update a student's details, including RFID
        public function updateStudent($studentId, $studentRfid, $firstName, $lastName, $email, $birthdate, $phone, $address, $gender, $guardianName, $guardianContact, $level, $courseId, $profilePicturePath = null) {
            $query = "UPDATE students 
                    SET student_firstname = :firstName, student_lastname = :lastName, student_email = :email, 
                        student_birthdate = :birthdate, student_phone = :phone, student_address = :address, 
                        student_gender = :gender, guardian_name = :guardianName, guardian_contact = :guardianContact, 
                        student_rfid = :studentRfid, student_level = :level, course_id = :courseId";
            
            // Include profile picture update only if a new file path is provided
            if ($profilePicturePath !== null) {
                $query .= ", profile_picture = :profilePicture";
            }

            $query .= " WHERE student_id = :studentId";
            
            $statement = $this->pdo->prepare($query);

            $statement->bindParam(':studentId', $studentId);
            $statement->bindParam(':studentRfid', $studentRfid);
            $statement->bindParam(':firstName', $firstName);
            $statement->bindParam(':lastName', $lastName);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':birthdate', $birthdate);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':address', $address);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':guardianName', $guardianName);
            $statement->bindParam(':guardianContact', $guardianContact);
            $statement->bindParam(':level', $level);
            $statement->bindParam(':courseId', $courseId);

            // Bind profile picture if provided
            if ($profilePicturePath !== null) {
                $statement->bindParam(':profilePicture', $profilePicturePath);
            }

            $statement->execute();
        }       

        // Delete a student by ID
        public function deleteStudent($studentId) {
            $query = "UPDATE students SET deleted = TRUE, deleted_at = NOW() WHERE student_id = :studentId";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':studentId', $studentId);
            return $statement->execute();
        }

        // Restore deleted student
        public function restoreStudent($studentId) {
            $query = "UPDATE students SET deleted = FALSE, deleted_at = NULL WHERE student_id = :studentId";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':studentId', $studentId);
            return $statement->execute();
        }    

        // Method to check if student_id already exists
        public function studentIdExists($studentId) {
            $query = "SELECT COUNT(*) FROM students WHERE student_id = :studentId";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':studentId', $studentId);
            $statement->execute();
            return $statement->fetchColumn() > 0;
        }

        // Method to check if student_rfid already exists
        public function studentRfidExists($studentRfid) {
            $query = "SELECT COUNT(*) FROM students WHERE student_rfid = :studentRfid";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':studentRfid', $studentRfid);
            $statement->execute();
            return $statement->fetchColumn() > 0;
        }

        // Get all list of course
        public function getAllCourses() {
            $query = "SELECT course_id, course_name FROM courses";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getStudentByRfid($rfid) {
            $query = "SELECT * FROM students WHERE student_rfid = :rfid";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':rfid', $rfid);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        // get attendance table to display in teacher dashboard
        public function getAttendanceData($studentId = null, $date = null) {
            $query = "
                SELECT 
                    a.student_id,
                    CONCAT(s.student_firstname, ' ', s.student_lastname) AS full_name,
                    s.student_level,
                    c.course_name,
                    s.profile_picture,
                    a.date,
                    a.time_in,
                    a.time_out
                FROM attendance a
                JOIN students s ON a.student_id = s.student_id
                LEFT JOIN courses c ON s.course_id = c.course_id
                WHERE 1=1
            ";
            
            $params = [];
            
            if ($studentId) {
                $query .= " AND a.student_id = :student_id";
                $params[':student_id'] = $studentId;
            }
            
            if ($date) {
                $query .= " AND DATE(a.date) = :date";
                $params[':date'] = $date;
            }
            
            $query .= " ORDER BY a.date DESC, a.time_in DESC";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
        // get total checkin today
        public function countDistinctCheckInToday() {
            $query = "
                SELECT COUNT(DISTINCT student_id) as checkin_count
                FROM attendance
                WHERE time_in IS NOT NULL
                  AND date = CURDATE()
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['checkin_count'];
        }        

        // get total checkout today
        public function countDistinctCheckOutToday() {
            $query = "
                SELECT COUNT(DISTINCT student_id) as checkout_count
                FROM attendance
                WHERE time_out IS NOT NULL
                  AND date = CURDATE()
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['checkout_count'];
        }

        // Check if email exists, excluding the current student ID
        public function emailExists($email, $studentId) {
            $query = "SELECT COUNT(*) FROM students WHERE student_email = :email AND student_id != :studentId";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':studentId', $studentId);
            $statement->execute();
            return $statement->fetchColumn() > 0;
        }

        // Check if RFID exists, excluding the current student ID
        public function rfidExists($rfid, $studentId) {
            $query = "SELECT COUNT(*) FROM students WHERE student_rfid = :rfid AND student_id != :studentId";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':rfid', $rfid);
            $statement->bindParam(':studentId', $studentId);
            $statement->execute();
            return $statement->fetchColumn() > 0;
        }

        // Method to handle bulk upload of students
        public function bulkUploadStudents($data) {
            $this->pdo->beginTransaction();
            try {
                $successCount = 0;
                $errors = [];
                $defaultProfilePicture = '../../uploads/pp.png';

                foreach ($data as $index => $row) {
                    // Skip empty rows
                    if (empty(array_filter($row))) {
                        continue;
                    }

                    // Validate required fields
                    if (empty($row['student_id']) || empty($row['student_firstname']) || empty($row['student_lastname'])) {
                        $errors[] = "Row " . ($index + 2) . ": Missing required fields (Student ID, First Name, or Last Name)";
                        continue;
                    }

                    // Check if student ID already exists
                    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM students WHERE student_id = ? AND deleted = FALSE");
                    $stmt->execute([$row['student_id']]);
                    if ($stmt->fetchColumn() > 0) {
                        $errors[] = "Row " . ($index + 2) . ": Student ID {$row['student_id']} already exists";
                        continue;
                    }

                    // Prepare the SQL query
                    $query = "INSERT INTO students (
                        student_id, student_firstname, student_lastname, student_email,
                        student_birthdate, student_phone, student_address, student_gender,
                        guardian_name, guardian_contact, student_level, course_id, student_rfid,
                        profile_picture
                    ) VALUES (
                        :student_id, :firstname, :lastname, :email,
                        :birthdate, :phone, :address, :gender,
                        :guardian_name, :guardian_contact, :level, :course_id, :rfid,
                        :profile_picture
                    )";

                    $stmt = $this->pdo->prepare($query);

                    // Execute with proper parameter binding
                    try {
                        $stmt->execute([
                            ':student_id' => $row['student_id'],
                            ':firstname' => $row['student_firstname'],
                            ':lastname' => $row['student_lastname'],
                            ':email' => $row['student_email'] ?? null,
                            ':birthdate' => $row['student_birthdate'] ?? null,
                            ':phone' => $row['student_phone'] ?? null,
                            ':address' => $row['student_address'] ?? null,
                            ':gender' => $row['student_gender'] ?? null,
                            ':guardian_name' => $row['guardian_name'] ?? null,
                            ':guardian_contact' => $row['guardian_contact'] ?? null,
                            ':level' => $row['student_level'] ?? null,
                            ':course_id' => $row['course_id'] ?? null,
                            ':rfid' => $row['student_rfid'] ?? null,
                            ':profile_picture' => $defaultProfilePicture
                        ]);
                        $successCount++;
                    } catch (PDOException $e) {
                        $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                        continue;
                    }
                }

                if ($successCount > 0) {
                    $this->pdo->commit();
                    return [
                        'success' => true,
                        'message' => "$successCount students successfully uploaded",
                        'errors' => $errors
                    ];
                } else {
                    $this->pdo->rollBack();
                    return [
                        'success' => false,
                        'message' => "No students were uploaded",
                        'errors' => $errors
                    ];
                }
            } catch (Exception $e) {
                $this->pdo->rollBack();
                return [
                    'success' => false,
                    'message' => "An error occurred during upload",
                    'errors' => [$e->getMessage()]
                ];
            }
        }
    }
?>
