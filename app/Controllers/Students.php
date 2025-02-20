<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Mahasiswa;

class Students extends BaseController
{
    private $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new M_Mahasiswa();
    }

    public function index()
    {
        $parser = service('parser');

        $students = $this->mahasiswaModel->getAllStudentsArray();

        foreach ($students as &$student) {
            $student['status_cell'] = view_cell('AcademicStatusCell', ['status' => $student['status']], 86400, 'status_cell');
        }

        $data = [
            'title' => 'Student List',
            'students' => $students
        ];
        $data['grades_cell'] = view_cell('LatestGradesCell', ['grades' => [90, 80, 90, 70, 70]], 21600, 'grades_cell');
        $data['content'] = $parser->setData($data)->render('students/student_list', ['cache' => 1800, 'cache_name' => 'student_list']);

        return view('partials/parser_layout', $data);
    }

    public function profile($nim)
    {
        $parser = service('parser');
        $student = $this->mahasiswaModel->getStudentArrayByNIM($nim);

        $data = [
            'title' => 'Student Profile',
            'student' => [$student]
        ];
        $data['status_cell'] = view_cell('AcademicStatusCell', ['status' => $student['status']], 86400, 'status_cell');
        $data['grades_cell'] = view_cell('LatestGradesCell', ['grades' => [90, 80, 90, 70, 70]], 21600, 'grades_cell');
        $data['content'] = $parser->setData($data)->render('students/profile');

        return view('partials/parser_layout', $data);
    }
}
