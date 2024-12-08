<?php
    class Attendance {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Method to check if there's an existing attendance record for today
        public function getTodayRecord($studentId, $date) {
            $query = "SELECT * FROM attendance WHERE student_id = :studentId AND date = :date AND time_out IS NULL";
            $statement = $this->pdo->prepare($query);
            $statement->execute([':studentId' => $studentId, ':date' => $date]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        // Method to record a check-in (create a new attendance entry)
        public function recordCheckIn($studentId, $date, $timeIn) {
            $query = "INSERT INTO attendance (student_id, date, time_in, status) VALUES (:studentId, :date, :timeIn, 'IN')";
            $statement = $this->pdo->prepare($query);
            $statement->execute([':studentId' => $studentId, ':date' => $date, ':timeIn' => $timeIn]);
            return $this->pdo->lastInsertId();
        }

        // Method to record a check-out (update an existing attendance entry)
        public function recordCheckOut($attendanceId, $timeOut) {
            $query = "UPDATE attendance SET time_out = :timeOut, status = 'OUT', created_at = CURRENT_TIMESTAMP WHERE attendance_id = :attendanceId";
            $statement = $this->pdo->prepare($query);
            $statement->execute([':timeOut' => $timeOut, ':attendanceId' => $attendanceId]);
        }

        // Method to get a list of recent attendance entries for displaying recent swipes
        public function getRecentAttendance($limit = 3) {
            $query = "SELECT attendance.*, students.student_firstname, students.student_lastname, students.profile_picture, students.course_id
                    FROM attendance
                    JOIN students ON attendance.student_id = students.student_id
                    ORDER BY attendance.time_in DESC
                    LIMIT :limit";
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLastAttendanceRecord($studentId) {
            $query = "SELECT * FROM attendance 
                      WHERE student_id = :student_id 
                      ORDER BY created_at DESC 
                      LIMIT 1";
            
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':student_id', $studentId);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        // Method to check if student already checked out today
        public function hasCheckedOutToday($studentId, $date) {
            $query = "SELECT * FROM attendance WHERE student_id = :studentId AND date = :date AND time_out IS NOT NULL";
            $statement = $this->pdo->prepare($query);
            $statement->execute([':studentId' => $studentId, ':date' => $date]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
?>
