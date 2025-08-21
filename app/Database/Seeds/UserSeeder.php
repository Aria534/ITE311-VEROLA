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
                'username' => 'AliceR',
                'email'    => 'alice.r@example.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            [
                'username' => 'BobM',
                'email'    => 'bob.m@example.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            [
                'username' => 'CarolS',
                'email'    => 'carol.s@example.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            // Instructors
            [
                'username' => 'Prof. DavidT',
                'email'    => 'david.t@example.com',
                'password' => password_hash('instructor123', PASSWORD_DEFAULT),
                'role'     => 'instructor',
            ],
            [
                'username' => 'Prof. EmmaL',
                'email'    => 'emma.l@example.com',
                'password' => password_hash('instructor123', PASSWORD_DEFAULT),
                'role'     => 'instructor',
            ],
            // Admin
            [
                'username' => 'AdminUser',
                'email'    => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
