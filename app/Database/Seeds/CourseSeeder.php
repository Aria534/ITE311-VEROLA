<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $this->db->disableForeignKeyChecks();
        $this->db->table('enrollments')->truncate();
        $this->db->table('courses')->truncate();
        $this->db->enableForeignKeyChecks();

        $data = [
            [
                'course_name'   => 'Introduction to Programming',
                'description'   => 'Learn the basics of coding using Python and logic building.',
                'instructor_id' => 4,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Web Development Fundamentals',
                'description'   => 'Build and design basic websites using HTML, CSS, and JavaScript.',
                'instructor_id' => 4,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Object-Oriented Programming',
                'description'   => 'Master OOP concepts like classes, inheritance, and polymorphism.',
                'instructor_id' => 4,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Mobile App Development',
                'description'   => 'Create cross-platform mobile applications using modern frameworks.',
                'instructor_id' => 4,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Software Engineering Principles',
                'description'   => 'Study SDLC, agile methodologies, and software design patterns.',
                'instructor_id' => 4,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Database Management Systems',
                'description'   => 'Understand relational databases and SQL fundamentals.',
                'instructor_id' => 5,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Data Structures and Algorithms',
                'description'   => 'Learn how to organize and optimize data efficiently.',
                'instructor_id' => 5,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Computer Networks',
                'description'   => 'Explore networking protocols, TCP/IP, and network security basics.',
                'instructor_id' => 5,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Operating Systems',
                'description'   => 'Understand OS concepts including processes, memory, and file systems.',
                'instructor_id' => 5,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'course_name'   => 'Information Security',
                'description'   => 'Learn cybersecurity fundamentals, encryption, and threat prevention.',
                'instructor_id' => 5,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('courses')->insertBatch($data);
    }
}