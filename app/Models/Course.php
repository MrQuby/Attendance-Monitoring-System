<?php

class Course {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCourses() {
        $stmt = $this->pdo->query("SELECT * FROM courses WHERE deleted_at IS NULL ORDER BY course_name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE course_id = ? AND deleted_at IS NULL");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkCourseExists($courseId) {
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE course_id = ?");
        $stmt->execute([$courseId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCourse($courseId, $courseName, $courseDescription) {
        // First check if the course exists (including soft-deleted ones)
        $existingCourse = $this->checkCourseExists($courseId);
        
        if ($existingCourse) {
            // If the course exists and is soft-deleted, restore it
            if ($existingCourse['deleted_at'] !== null) {
                $stmt = $this->pdo->prepare("UPDATE courses SET course_name = ?, course_description = ?, deleted_at = NULL, updated_at = CURRENT_TIMESTAMP WHERE course_id = ?");
                if ($stmt->execute([$courseName, $courseDescription, $courseId])) {
                    return 'restored'; // Return 'restored' when successfully restoring a deleted course
                }
                return false;
            }
            // If the course exists and is not deleted, return 'exists'
            return 'exists';
        }
        
        // If the course doesn't exist at all, create a new one
        $stmt = $this->pdo->prepare("INSERT INTO courses (course_id, course_name, course_description) VALUES (?, ?, ?)");
        return $stmt->execute([$courseId, $courseName, $courseDescription]) ? true : false;
    }

    public function updateCourse($courseId, $courseName, $courseDescription) {
        $stmt = $this->pdo->prepare("UPDATE courses SET course_name = ?, course_description = ?, updated_at = CURRENT_TIMESTAMP WHERE course_id = ?");
        return $stmt->execute([$courseName, $courseDescription, $courseId]);
    }

    public function softDeleteCourse($courseId) {
        $stmt = $this->pdo->prepare("UPDATE courses SET deleted_at = CURRENT_TIMESTAMP WHERE course_id = ?");
        return $stmt->execute([$courseId]);
    }
}
