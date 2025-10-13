<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'course_name'   => 'Introduction to Programming',
                'description'   => 'Learn the basics of coding using Python and logic building.',
                'instructor_id' => 4, // Jim Jamero
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Database Management Systems',
                'description'   => 'Understand relational databases and SQL fundamentals.',
                'instructor_id' => 5, // Bryll Nosotros
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Web Development Fundamentals',
                'description'   => 'Build and design basic websites using HTML, CSS, and JavaScript.',
                'instructor_id' => 4, // Jim Jamero
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Data Structures and Algorithms',
                'description'   => 'Learn how to organize and optimize data efficiently.',
                'instructor_id' => 5, // Bryll Nosotros
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('courses')->insertBatch($data);
    }
}
