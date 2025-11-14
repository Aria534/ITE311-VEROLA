<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table            = 'enrollments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['user_id', 'course_id', 'enrollment_date'];

    // Correct visibility for timestamps property
    protected $useTimestamps = false; // We manually set enrollment_date

    /**
     * ✅ Get all enrollments with course details for a specific user
     */
    public function getUserEnrollments($userId)
    {
        return $this->select('enrollments.*, courses.course_name, courses.description, users.username AS instructor_name')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->join('users', 'users.id = courses.instructor_id', 'left')
                    ->where('enrollments.user_id', $userId)
                    ->findAll();
    }

    /**
     * ✅ Check if the user is already enrolled in a course
     */
    public function isUserEnrolled($userId, $courseId)
    {
        return $this->where('user_id', $userId)
                    ->where('course_id', $courseId)
                    ->first() !== null;
    }

    /**
     * Get distinct students (users) who are enrolled in courses taught by a specific teacher
     *
     * @param int $teacherId
     * @return array
     */
    public function getStudentsByTeacher($teacherId)
    {
        return $this->select('users.id AS user_id, users.username, users.email')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->join('users', 'users.id = enrollments.user_id')
                    ->where('courses.instructor_id', $teacherId)
                    ->groupBy('users.id')
                    ->findAll();
    }
}



