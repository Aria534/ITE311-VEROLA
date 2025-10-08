<?php


namespace App\Models;


use CodeIgniter\Model;


class EnrollmentModel extends Model
    {
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];
    protected $useTimestamps = false; // we set enrollment_date manually


    /**
    * Inserts a new enrollment record. Returns insert ID or false.
    */
    public function enrollUser(array $data)
    {
    return $this->insert($data);
    }


    /**
    * Returns all enrolled courses for a user (with course details)
    */
    public function getUserEnrollments($user_id)
    {
    return $this->select('enrollments.*, courses.id as course_id, courses.title as course_title, courses.description')
    ->join('courses', 'courses.id = enrollments.course_id')
    ->where('enrollments.user_id', $user_id)
    ->orderBy('enrollment_date', 'DESC')
    ->findAll();
    }


    /**
    * Checks duplicate enrollment
    */
    public function isAlreadyEnrolled($user_id, $course_id)
    {
    return (bool) $this->where(['user_id' => $user_id, 'course_id' => $course_id])->first();
    }
}