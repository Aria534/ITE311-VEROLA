<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $this->db->disableForeignKeyChecks();
        $this->db->table('enrollments')->truncate();
        $this->db->enableForeignKeyChecks();

        $enrollments = [
            1 => [1, 2, 3, 6, 7],
            2 => [1, 4, 5, 8, 9],
            3 => [2, 3, 6, 9, 10],
        ];

        $data = [];
        foreach ($enrollments as $userId => $courses) {
            foreach ($courses as $courseId) {
                $data[] = [
                    'user_id'         => $userId,
                    'course_id'       => $courseId,
                    'enrollment_date' => date('Y-m-d H:i:s'),
                    'created_at'      => date('Y-m-d H:i:s'),
                    'updated_at'      => date('Y-m-d H:i:s'),
                ];
            }
        }

        $this->db->table('enrollments')->insertBatch($data);
    }
}