<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table      = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];
    protected $useTimestamps = false;

    /**
     * Insert a new enrollment record.
     * $data = ['user_id' => int, 'course_id' => int, 'enrollment_date' => 'YYYY-MM-DD HH:MM:SS']
     */
    public function enrollUser(array $data)
    {
        return $this->insert($data);
    }

    /**
     * Get all enrollments for a user (joins course info).
     */
    public function getUserEnrollments(int $user_id)
    {
        return $this->select('enrollments.*, courses.id as course_id, courses.course_name, courses.description, courses.credits')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->where('enrollments.user_id', $user_id)
                    ->orderBy('enrollments.enrollment_date', 'DESC')
                    ->findAll();
    }

    /**
     * Check if user already enrolled in a course.
     */
    public function isAlreadyEnrolled(int $user_id, int $course_id): bool
    {
        return (bool) $this->where(['user_id' => $user_id, 'course_id' => $course_id])->countAllResults();
    }
}
