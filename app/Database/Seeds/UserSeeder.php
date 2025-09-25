<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Students
            [
                'username' => 'Aira',
                'email'    => 'airaverola@gmail.com',
                'password' => password_hash('airaverola123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            [
                'username' => 'Jela',
                'email'    => 'jela@gmail.com',
                'password' => password_hash('jelat123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            [
                'username' => 'Mia',
                'email'    => 'mia@gmail.com',
                'password' => password_hash('mia123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            // Instructors
            [
                'username' => 'Prof. Jim',
                'email'    => 'jim123@gmail.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role'     => 'teacher',
            ],
            [
                'username' => 'Prof. Bryll',
                'email'    => 'bryll@gmail.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role'     => 'teacher',
            ],
            // Admin
            [
                'username' => 'Admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
