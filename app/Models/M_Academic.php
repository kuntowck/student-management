<?php

namespace App\Models;

class M_Academic
{
    private $courses = [];

    public function __construct()
    {
        $this->courses = [
            [
                'kode' => 'CS101',
                'nama' => 'Introduction to Computer Science'
            ],
            [
                'kode' => 'CS102',
                'nama' => 'Data Structures',
            ],
            [
                'kode' => 'CS103',
                'nama' => 'Algorithms',
            ],
            [
                'kode' => 'CS104',
                'nama' => 'Operating Systems',
            ],
            [
                'kode' => 'CS105',
                'nama' => 'Database Systems',
            ],
        ];
    }

    public function getAllCoursesArray()
    {
        $courses = [];

        foreach ($this->courses as $course) {
            $courses[] = [
                'kode' => $course['kode'],
                'nama' => $course['nama']
            ];
        }

        return $courses;
    }
}
