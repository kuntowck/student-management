<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\DataParams;
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

        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'studyProgram' => $this->request->getGet('studyProgram'),
            'status' => $this->request->getGet('status'),
            'entryYear' => $this->request->getGet('entryYear'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page' => $this->request->getGet('page_students'),
            'perPage' => $this->request->getGet('perPage')
        ]);

        $results = $this->studentModel->asArray()->getFilteredStudents($params);

        foreach ($results['students'] as &$student) {
            $student['status_cell'] = view_cell('AcademicStatusCell', ['status' => $student['academic_status']]);
            $student['grades_cell'] = view_cell('LatestGradesCell', ['grades' => [90, 80, 90, 70, 70]], 21600, 'grades_cell');
        }

        $dataParser = [
            'students' => $results['students'],
            'tableHeader' => [
                [
                    'name' => 'NIM',
                    'href' => $params->getSortUrl('student_id', base_url('student')),
                    'is_sorted' => $params->isSortedBy('student_id') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Name',
                    'href' => $params->getSortUrl('name', base_url('student')),
                    'is_sorted' => $params->isSortedBy('name') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Study Program',
                    'href' => $params->getSortUrl('study_program', base_url('student')),
                    'is_sorted' => $params->isSortedBy('study_program') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Current Semester',
                    'href' => $params->getSortUrl('current_semester', base_url('student')),
                    'is_sorted' => $params->isSortedBy('current_semester') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Entry Year',
                    'href' => $params->getSortUrl('entry_year', base_url('student')),
                    'is_sorted' => $params->isSortedBy('entry_year') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'GPA',
                    'href' => $params->getSortUrl('gpa', base_url('student')),
                    'is_sorted' => $params->isSortedBy('gpa') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Status',
                    'href' => $params->getSortUrl('academic_status', base_url('student')),
                    'is_sorted' => $params->isSortedBy('academic_status') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
            ],
        ];

        $data = [
            'title' => 'Student List',
            'params' => $params,
            'pager' => $results['pager'],
            'total' => $results['total'],
            'studyProgram' => $this->studentModel->getAllStudyProgram(),
            'statuses' => $this->studentModel->getAllStatus(),
            'entryYears' => $this->studentModel->getAllEntryYear(),
            'baseURL' => base_url('student'),
            
        ];

        $data['content'] = $parser->setData($dataParser)->render('partials/parser_student_list');

        return view('students/index', $data);
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
