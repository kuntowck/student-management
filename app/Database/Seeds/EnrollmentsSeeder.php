<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class EnrollmentsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'student_id' => '2501',
            'course_id' => 1,
            'academic_year' => 2025,
            'semester' => 1,
            'status' => 'active',
            'created_at' => new Time('now'),
            'updated_at' => new Time('now')
        ];

        $this->db->table('enrollments')->insert($data);
    }
}
