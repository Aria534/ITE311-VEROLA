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
                'username' => 'Aira P. Verola',
                'email'    => 'airaverola@gmail.com',
                'password' => password_hash('airaverola123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            [
                'username' => 'Hazel Acierto',
                'email'    => 'hazel@gmail.com',
                'password' => password_hash('hazel123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            [
                'username' => 'Leizl Casilao',
                'email'    => 'leizl@gmail.com',
                'password' => password_hash('leizl123', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
            // Teacher
            [
                'username' => 'Jim Jamero',
                'email'    => 'teacherjim@gmail.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role'     => 'teacher',
            ],
            [
                'username' => 'Bryll Nosotros',
                'email'    => 'teacherbryll@gmail.com',
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
