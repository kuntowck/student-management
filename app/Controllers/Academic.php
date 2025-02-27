<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Academic;
use App\Models\M_Mahasiswa;

class Academic extends BaseController
{
    private $academicModel, $mahasiswaModel;

    public function __construct()
    {
        $this->academicModel = new M_Academic();
        $this->mahasiswaModel = new M_Mahasiswa();
    }

    public function index()
    {
        $courses = $this->academicModel->getAllCoursesArray();

        $data = [
            'title' => 'Course List',
            'courses' => $courses
        ];

        return view('academic/course_list', $data);
    }

    public function statistic()
    {
        $students = count($this->mahasiswaModel->getAllStudentsArray());
        $courses = count($this->academicModel->getAllCoursesArray());

        $data = [
            'title' => 'Academic Statistics',
            'students' => $students,
            'courses' => $courses
        ];

        return view('academic/statistics', $data);
    }
}
