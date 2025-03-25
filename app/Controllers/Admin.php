<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\StudentModel;

class Admin extends BaseController
{
    protected $courseModel, $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
    }

    public function dashboard()
    {
        return view('partials/dashboard');
    }

    public function statistic()
    {
        $students = count($this->studentModel->findAll());
        $courses = count($this->courseModel->findAll());

        $data = [
            'title' => 'Academic Statistics',
            'students' => $students,
            'courses' => $courses
        ];

        return view('admin/statistics', $data);
    }
}
