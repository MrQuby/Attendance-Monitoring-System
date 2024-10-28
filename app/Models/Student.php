<?php
class Student {
    private $pdo;

    // Constructor to initialize the PDO instance (database connection)
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Method to fetch all students, with optional filtering by student ID
    public function getAllStudents($studentId = null) {
        // Base query
        $query = "SELECT students.student_id, students.student_firstname, students.student_lastname, students.student_email, students.student_level, 
                         courses.course_id, courses.course_name 
                  FROM students 
                  LEFT JOIN courses ON students.course_id = courses.course_id
                  WHERE students.deleted = FALSE";  // Only fetch students that are not marked as deleted
    
        // Add WHERE clause if filtering by student ID
        if ($studentId) {
            $query .= " AND students.student_id LIKE :studentId";
        }
    
        $statement = $this->pdo->prepare($query);
    
        // Bind the student ID if provided
        if ($studentId) {
            $searchTerm = '%' . $studentId . '%';
            $statement->bindParam(':studentId', $searchTerm);
        }
    
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);  // Fetch all students
    }    

    // Method to add a student with manually inputted student_id
    public function addStudent($studentId, $firstName, $lastName, $email, $birthdate, $phone, $address, $gender, $guardianName, $guardianContact, $level, $courseId, $profilePicturePath) {
        $query = "INSERT INTO students (student_id, student_firstname, student_lastname, student_email, student_birthdate, student_phone, student_address, student_gender, guardian_name, guardian_contact, student_level, course_id, profile_picture) 
                VALUES (:studentId, :firstName, :lastName, :email, :birthdate, :phone, :address, :gender, :guardianName, :guardianContact, :level, :courseId, :profilePicturePath)";
                
        $statement = $this->pdo->prepare($query);

        // Bind parameters
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

        $statement->execute();
    }

        
    
    // Get a student by ID
    public function getStudentById($studentId) {
        $query = "SELECT student_id, student_firstname, student_lastname, student_email, student_birthdate, 
                         student_phone, student_address, student_gender, guardian_name, guardian_contact, 
                         student_level, course_id, profile_picture  -- Include profile_picture
                  FROM students 
                  WHERE student_id = :studentId";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':studentId', $studentId);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // Method to update a student's details
    public function updateStudent($studentId, $firstName, $lastName, $email, $birthdate, $phone, $address, $gender, $guardianName, $guardianContact, $level, $courseId, $profilePicturePath = null) {
        $query = "UPDATE students 
                  SET student_firstname = :firstName, student_lastname = :lastName, student_email = :email, 
                      student_birthdate = :birthdate, student_phone = :phone, student_address = :address, 
                      student_gender = :gender, guardian_name = :guardianName, guardian_contact = :guardianContact, 
                      student_level = :level, course_id = :courseId";
        
        // Include profile picture update only if a new file path is provided
        if ($profilePicturePath !== null) {
            $query .= ", profile_picture = :profilePicture";
        }
    
        $query .= " WHERE student_id = :studentId";
        
        $statement = $this->pdo->prepare($query);
    
        // Bind parameters
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
        $statement->bindParam(':studentId', $studentId);
    
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
        return $statement->fetchColumn() > 0;  // Returns true if student_id exists
    }

    // Get all list of course
    public function getAllCourses() {
        $query = "SELECT course_id, course_name FROM courses";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>