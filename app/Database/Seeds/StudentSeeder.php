<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'student_id' => '2501',
            'name' => 'Kunto Wicaksono',
            'study_program' => 'Informatics',
            'current_semester' => 8,
            'academic_status' => 'active',
            'entry_year' => 2025,
            'gpa' => 3.40,
            'created_at' => new Time('-3 weeks'),
            'updated_at' => new Time('now')
        ];

        $this->db->table('students')->insert($data);
    }
}
