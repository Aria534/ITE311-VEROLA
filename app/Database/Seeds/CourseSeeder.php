<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'course_title'         => 'Introduction to Programming',
                'description'   => 'Learn the basics of coding using Python and logic building.',
                'instructor_id' => 1,
            ],
            [
                'course_title'         => 'Database Management Systems',
                'description'   => 'Understand relational databases and SQL fundamentals.',
                'instructor_id' => 1,
            ],
            [
                'course_title'         => 'Web Development Fundamentals',
                'description'   => 'Build and design basic websites using HTML, CSS, and JavaScript.',
                'instructor_id' => 1,
            ],
            [
                'course_title'         => 'Data Structures and Algorithms',
                'description'   => 'Learn how to organize and optimize data efficiently.',
                'instructor_id' => 1,
            ],
        ];

        // Insert into table "courses"
        $this->db->table('courses')->insertBatch($data);
    }
}
