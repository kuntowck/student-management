<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class Students extends BaseController
{
    private $studentModel;

    public function __construct()
    {

        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $parser = service('parser');

        $students = $this->studentModel->getAllStudentsArray();

        foreach ($students as &$student) {
            $student['status_cell'] = view_cell('AcademicStatusCell', ['status' => $student['academic_status']]);
        }

        $data = [
            'title' => 'Student List',
            'students' => $students
        ];
        $data['grades_cell'] = view_cell('LatestGradesCell', ['grades' => [90, 80, 90, 70, 70]], 21600, 'grades_cell');
        $data['content'] = $parser->setData($data)->render('students/student_list');

        return view('partials/parser_layout', $data);
    }

    public function profile($id)
    {
        $parser = service('parser');
        $student = $this->studentModel->getStudentArrayByID($id);

        $data = [
            'title' => 'Student Profile',
            'student' => [$student]
        ];
        $data['status_cell'] = view_cell('AcademicStatusCell', ['status' => $student['academic_status']], 86400, 'status_cell');
        $data['grades_cell'] = view_cell('LatestGradesCell', ['grades' => [90, 80, 90, 70, 70]], 21600, 'grades_cell');
        $data['content'] = $parser->setData($data)->render('students/profile');

        return view('partials/parser_layout', $data);
    }

    public function create()
    {
        return view("students/create");
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (!$this->studentModel->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->studentModel->errors());
        }

        $this->studentModel->save($data);

        return redirect()->to('/student');
    }

    public function update($id)
    {
        $data['student'] = $this->studentModel->getStudentArrayByID($id);

        return view('students/update', $data);
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        if (!$this->studentModel->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->studentModel->errors());
        }

        $this->studentModel->update($id, $data);

        return redirect()->to('/student');
    }

    public function delete($id)
    {
        $this->studentModel->delete($id);

        return redirect()->to('/student');
    }
}
