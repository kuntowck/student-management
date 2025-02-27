<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'code' => 101,
            'name' => 'Data Structure',
            'credits' => 4,
            'semester' => 2,
            'created_at' => new Time('-10 year'),
            'updated_at' => new Time('-2 year')
        ];

        $this->db->table('courses')->insert($data);
    }
}
