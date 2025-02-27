<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableEnrollments extends Migration
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
            'student_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'course_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null'       => false,
            ],
            'academic_year' => [
                'type'       => 'YEAR',
                'null'       => false,
            ],
            'semester' => [
                'type'       => 'INT',
                'constraint' => 2,
                'unsigned'   => true,
                'null'       => false,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'active',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('course_id', 'courses', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('enrollments');
    }

    public function down()
    {
        $this->forge->dropTable('enrollments');
    }
}
