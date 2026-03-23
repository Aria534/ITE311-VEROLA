<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'course_name',
        'description',
        'instructor_id',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Optional: Get course with instructor info (joins with users table)
    public function getCourseWithInstructor()
    {
        return $this->select('courses.*, users.username as instructor_name')
                    ->join('users', 'users.id = courses.instructor_id', 'left')
                    ->findAll();
    }
}
