<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\StudentModel;

class Enrollment extends BaseController
{
    private $studentModel, $enrollmentModel, $courseModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->courseModel = new CourseModel();
    }

    public function index()
    {
        $student = $this->studentModel->where('email', user()->email)->first();

        if (!empty($student)) {
            $enrollments = $this->enrollmentModel->getEnrollmentStudentCourse($student->student_id);

            $data = [
                'title' => 'Enrollment Management',
                'enrollments' => $enrollments
            ];

            return view('enrollments/index', $data);
        }

        return redirect()->back()->with('error', "Cannot access enrollment. You don't have data student.");
    }

    public function create()
    {
        $courses = $this->courseModel->select('id, code, name')->findAll();

        $data = [
            'title' => 'Course Registration',
            'courses' => $courses
        ];

        return view('enrollments/create', $data);
    }

    public function store()
    {
        $student = $this->studentModel->where('email', user()->email)->first();

        $enrollments = $this->request->getPost();
        $enrollments['student_id'] = $student->student_id;

        if (!$this->enrollmentModel->save($enrollments)) {
            return redirect()->back()->withInput()->with('errors', $this->enrollmentModel->errors());
        }

        $this->sendEmail();

        return redirect()->to('student/enrollment')->with('message', 'Course has been successfully registered, and a confirmation email has been sent.');
    }

    public function sendEmail()
    {
        $student = $this->studentModel->where('email', user()->email)->first();

        $enrollment = $this->enrollmentModel->getLastEnrollment($student->student_id);

        $email = service('email');

        $email->setFrom('kuntowck@gmail.com', 'Kunto');
        $email->setTo($student->email);
        $email->setSubject('Course Registration Confirmation');

        $data = [
            'student_name' => $student->name,
            'student_id' => $student->student_id,
            'enrollment' => $enrollment,
        ];

        $message = view('email/course_register', $data);
        $email->setMessage($message);

        if ($email->send()) {
            return redirect()->to('student/enrollment');
        } else {
            return redirect()->to('student/enrollment')->with('error', $email->printDebugger());
        }
    }
}
