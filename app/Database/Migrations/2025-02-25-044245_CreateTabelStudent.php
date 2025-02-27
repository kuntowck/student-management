<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'unique' => true,
                'null' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'study_program' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'current_semester' => [
                'type' => 'INT',
                'constraint' => 2,
                'null' => false,
            ],
            'academic_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'entry_year' => [
                'type' => 'YEAR',
                'null' => false,
            ],
            'gpa' => [
                'type' => 'DECIMAL',
                'constraint' => '3,2',
                'null' => true,
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
        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}
