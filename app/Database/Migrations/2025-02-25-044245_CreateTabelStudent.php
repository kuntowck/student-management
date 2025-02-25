<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelStudent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'student_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'null' => true,
            ],
            'study_program' => [
                'type' => 'VARCHAR',
                'null' => true,
            ],
            'current_semester' => [
                'type' => 'INT',
                'null' => true,
            ],
            'academic_status' => [
                'type' => 'VARCHAR',
                'null' => true,
            ],
            'entry_year' => [
                'type' => 'INT',
                'null' => true,
            ],
            'gpa' => [
                'type' => 'DECIMAL',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('student_id', 'studentId');
        $this->forge->createTable('student');
    }

    public function down()
    {
        //
    }
}
