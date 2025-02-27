<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableStudentGrades extends Migration
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
            'enrollment_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'grade_value' => [
                'type'       => 'DECIMAL',
                'constraint' => '4,2',
                'null'       => false,
            ],
            'grade_letter' => [
                'type'       => 'ENUM',
                'constraint' => ['A', 'B', 'C', 'D', 'E'],
                'null'       => false,
            ],
            'completed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('enrollment_id', 'enrollments', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('student_grades');
    }

    public function down()
    {
        $this->forge->dropTable('student_grades');
    }
}
