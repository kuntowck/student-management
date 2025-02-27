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
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'code' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'credits' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'semester' => [
                'type' => 'INT',
                'constraint' => 2,
                'null' => false
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
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
