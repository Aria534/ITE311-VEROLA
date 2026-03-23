<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome Back Students!',
                'content' => 'Classes for the new semester will start on October 20.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'System Maintenance',
                'content' => 'The portal will be offline for maintenance this weekend.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ]
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}
