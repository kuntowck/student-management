<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
        $data['courses'] = $this->courseModel->getAllCoursesArray();

        return view('courses/course_list', $data);
    }
    
    public function detail($id){
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

        if (!$this->courseModel->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->courseModel->errors());
        }

        $this->courseModel->save($data);

        return redirect()->to('/course');
    }

    public function update($id)
    {
        $data['course'] = $this->courseModel->getCourseArrayByID($id);

        return view('courses/update', $data);
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        if (!$this->courseModel->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->courseModel->errors());
        }

        $this->courseModel->update($id, $data);

        return redirect()->to('/course');
    }

    public function delete($id)
    {
        $this->courseModel->delete($id);

        return redirect()->to('/course');
    }
}
