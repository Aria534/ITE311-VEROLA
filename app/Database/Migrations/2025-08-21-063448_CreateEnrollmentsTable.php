<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'course_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'enrollment_date' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');
        $this->forge->addKey('course_id');

        // Create table
        $this->forge->createTable('enrollments', true);

        // Add foreign keys (if your DB engine supports FK)
        // Note: Some shared hosting or setups may require ALTER TABLE after create; this method works in many setups.
        $db = \Config\Database::connect();
        $db->query('ALTER TABLE `enrollments`
            ADD CONSTRAINT `fk_enrollments_user`
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `fk_enrollments_course`
            FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE;');
    }

    public function down()
    {
        $this->forge->dropTable('enrollments', true);
    }
}
