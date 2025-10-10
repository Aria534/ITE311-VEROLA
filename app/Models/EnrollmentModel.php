<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];
    protected $useTimestamps = false;

    /**
     * Enroll a user in a course
     */
    public function enrollUser(array $data)
    {
        if ($this->isAlreadyEnrolled($data['user_id'], $data['course_id'])) {
            return false;
        }
        return $this->insert($data);
    }

    /**
     * Get all courses a user is enrolled in
     */
    public function getUserEnrollments(int $user_id)
    {
        return $this->where('user_id', $user_id)
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->select('courses.id, courses.course_title, courses.description')
                    ->findAll();
    }

    /**
     * Check if a user is already enrolled
     */
    public function isAlreadyEnrolled(int $user_id, int $course_id)
    {
        return $this->where('user_id', $user_id)
                    ->where('course_id', $course_id)
                    ->first() ? true : false;
    }
}
