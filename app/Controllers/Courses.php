<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\DataParams;
use App\Models\CourseModel;

class Courses extends BaseController
{
    private $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }

    public function index()
    {
        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page' => $this->request->getGet('page_credits'),
            'perPage' => $this->request->getGet('perPage'),
            'credits' => $this->request->getGet('credits'),
            'semester' => $this->request->getGet('semester'),
        ]);

        $results = $this->courseModel->getFilteredCourses($params);

        $data = [
            'title' => 'Course Management',
            'params' => $params,
            'courses' => $results['courses'],
            'pager' => $results['pager'],
            'total' => $results['total'],
            'credits' => $this->courseModel->getAllCredits(),
            'semesters' => $this->courseModel->getAllSemesters(),
            'baseURL' => base_url('lecturer/courses'),
        ];

        return view('courses/index', $data);
    }

    public function detail($id)
    {
        $data['course'] = $this->courseModel->getCourseArrayByID($id);

        return view('courses/detail', $data);
    }

    public function create()
    {
        return view("courses/create");
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (!$this->courseModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->courseModel->errors());
        }

        return redirect()->to('lecturer/courses')->with('message', 'Course has been successfully added.');
    }

    public function update($id)
    {
        $data['course'] = $this->courseModel->getCourseArrayByID($id);

        return view('courses/update', $data);
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        if (!$this->courseModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->courseModel->errors());
        }

        $this->courseModel->update($id, $data);

        return redirect()->to('lecturer/courses')->with('message', 'Course has been successfully added.');
    }

    public function delete($id)
    {
        $this->courseModel->delete($id);

        return redirect()->to('lecturer/courses')->with('message', 'Course has been successfully added.');
    }
}
