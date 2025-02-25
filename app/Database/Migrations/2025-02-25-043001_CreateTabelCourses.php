<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelCourses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'code' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'credits' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'semester' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('code', 'courses_code');
        $this->forge->createTable('courses');
    }

    public function down()
    {
        $this->forge->dropTable('courses');
    }
}
