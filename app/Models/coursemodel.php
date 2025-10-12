<?php namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['course_title', 'description', 'instructor_id'];

    public function getAvailableCourses($userId)
    {
        return $this->db->table('courses c')
            ->select('c.id, c.course_title AS title, c.description')
            ->whereNotIn('c.id', function($builder) use ($userId) {
                return $builder->select('course_id')
                               ->from('enrollments')
                               ->where('user_id', $userId);
            })
            ->get()
            ->getResultArray();
    }

    public function getEnrolledCourses($userId)
    {
        return $this->db->table('enrollments e')
            ->select('c.course_title AS title, c.description')
            ->join('courses c', 'c.id = e.course_id')
            ->where('e.user_id', $userId)
            ->get()
            ->getResultArray();
    }
}
