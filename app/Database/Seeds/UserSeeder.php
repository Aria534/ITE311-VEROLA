<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
        [
            'username' => 'admin01',
            'email'    => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'admin',
        ],
        [
            'username' => 'instructor01',
            'email'    => 'instructor@example.com',
            'password' => password_hash('teach123', PASSWORD_DEFAULT),
            'role'     => 'instructor',
        ],
        [
            'username' => 'student01',
            'email'    => 'student1@example.com',
            'password' => password_hash('stud123', PASSWORD_DEFAULT),
            'role'     => 'student',
        ],
        [
            'username' => 'student02',
            'email'    => 'student2@example.com',
            'password' => password_hash('stud456', PASSWORD_DEFAULT),
            'role'     => 'student',
        ],
    ];

    $this->db->table('users')->insertBatch($data);
    }
}
