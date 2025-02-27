<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class StudentGradeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'enrollment_id' => 1,
            'grade_value' => 4.60,
            'grade_letter' => 'A',
            'completed_at' => new Time('-2 day'),
            'created_at' => new Time('-2 weeks'),
            'updated_at' => new Time('yesterday')
        ];

        $this->db->table('student_grades')->insert($data);
    }
}
