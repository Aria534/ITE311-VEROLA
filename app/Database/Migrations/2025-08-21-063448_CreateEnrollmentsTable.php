<?php

namespace App\Database\Migrations;

Use CodeIgniter\Database\Migration;

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
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP', // optional but recommended
            ],
        ]);

        // Primary key
        $this->forge->addKey('id', true);

        // Foreign keys (ensure `users` and `courses` tables exist)
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('course_id', 'courses', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('enrollments', true);
    }

    public function down()
    {
        // Drops the table (and its foreign keys)
        $this->forge->dropTable('enrollments', true);
    }
}
