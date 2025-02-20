<?php

namespace App\Models;

use App\Entities\Course;

class M_Course
{
    private $courses = [];

    public function __construct()
    {
        $this->courses = [
            new Course([
                'kode' => 'CS101',
                'nama' => 'Introduction to Computer Science'
            ]),
            new Course([
                'kode' => 'CS102',
                'nama' => 'Data Structures',
            ]),
            new Course([
                'kode' => 'CS103',
                'nama' => 'Algorithms',
            ]),
            new Course([
                'kode' => 'CS104',
                'nama' => 'Operating Systems',
            ]),
            new Course([
                'kode' => 'CS105',
                'nama' => 'Database Systems',
            ]),
        ];
    }

    public function getAllCoursesArray()
    {
        $courses = [];

        foreach ($this->courses as $course) {
            $courses[] = [
                'kode' => $course->kode,
                'nama' => $course->nama
            ];
        }

        return $courses;
    }
}
