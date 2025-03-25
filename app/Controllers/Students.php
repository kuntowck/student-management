<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\DataParams;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\StudentGradeModel;
use App\Models\StudentModel;

class Students extends BaseController
{
    private $studentModel, $enrollmentModel, $studentGradeModel, $courseModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->studentGradeModel = new StudentGradeModel();
        $this->courseModel = new CourseModel();
    }

    public function dashboard()
    {
        $student = $this->studentModel->select('student_id')->where('email', user()->email)->first();
        $studentId = $student->student_id;

        $creditsByGrade = $this->getCreditsByGrade($studentId);
        $creditComparison = $this->getCreditComparison($studentId);
        $gpaData = $this->getGpaPerSemester($studentId);

        return view('students/dashboard', [
            'creditsByGrade' => json_encode($creditsByGrade),
            'creditComparison' => json_encode($creditComparison),
            'gpaData' => json_encode($gpaData)
        ]);
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
                    'href' => $params->getSortUrl('student_id', base_url('admin/students')),
                    'is_sorted' => $params->isSortedBy('student_id') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Name',
                    'href' => $params->getSortUrl('name', base_url('admin/students')),
                    'is_sorted' => $params->isSortedBy('name') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Study Program',
                    'href' => $params->getSortUrl('study_program', base_url('admin/students')),
                    'is_sorted' => $params->isSortedBy('study_program') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Current Semester',
                    'href' => $params->getSortUrl('current_semester', base_url('admin/students')),
                    'is_sorted' => $params->isSortedBy('current_semester') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Entry Year',
                    'href' => $params->getSortUrl('entry_year', base_url('admin/students')),
                    'is_sorted' => $params->isSortedBy('entry_year') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'GPA',
                    'href' => $params->getSortUrl('gpa', base_url('admin/students')),
                    'is_sorted' => $params->isSortedBy('gpa') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
                [
                    'name' => 'Status',
                    'href' => $params->getSortUrl('academic_status', base_url('admin/students')),
                    'is_sorted' => $params->isSortedBy('academic_status') ? ($params->getSortDirection() == 'asc' ?
                        '↑' : '↓') : ''
                ],
            ],
        ];

        $data = [
            'title' => 'Student Management',
            'params' => $params,
            'pager' => $results['pager'],
            'total' => $results['total'],
            'studyProgram' => $this->studentModel->getAllStudyProgram(),
            'statuses' => $this->studentModel->getAllStatus(),
            'entryYears' => $this->studentModel->getAllEntryYear(),
            'baseURL' => base_url('admin/students'),

        ];

        $data['content'] = $parser->setData($dataParser)->render('students/parser_student_list');

        return view('students/index', $data);
    }

    public function detail($id)
    {
        $parser = service('parser');

        $student = $this->studentModel->getStudentArrayByID($id);

        $data = [
            'title' => 'Student Detail',
            'student' => [$student]
        ];
        $data['status_cell'] = view_cell('AcademicStatusCell', ['status' => $student['academic_status']], 86400, 'status_cell');
        $data['grades_cell'] = view_cell('LatestGradesCell', ['grades' => [90, 80, 90, 70, 70]], 21600, 'grades_cell');
        $data['content'] = $parser->setData($data)->render('students/parser_profile');

        return view('students/detail', $data);
    }

    public function profile()
    {
        $email = user()->__get('email');

        $student = $this->studentModel->select('students.*, users.username')
            ->join('users', 'users.email = students.email')
            ->where('users.email', $email)
            ->first();

        if (!empty($student)) {
            $data = [
                'title' => 'Student Profile',
                'student' => $student
            ];

            return view('students/profile', $data);
        }
        return redirect()->back()->with('error', "Cannot access profile. You don't have data student.");
    }

    public function create()
    {
        return view("students/create");
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (!$this->studentModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->studentModel->errors());
        }

        return redirect()->to('admin/students')->with('message', 'Student has been successfully added.');
    }

    public function update($id)
    {
        $data['student'] = $this->studentModel->getStudentArrayByID($id);

        return view('students/update', $data);
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        $this->studentModel->setValidationRule('student_id', "required|is_unique[students.student_id,id,{$id}]");

        if (!$this->studentModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->studentModel->errors());
        }

        return redirect()->to('admin/students')->with('message', 'Student has been successfully updated.');
    }

    public function delete($id)
    {
        $this->studentModel->delete($id);

        return redirect()->to('admin/students')->with('message', 'Student has been successfully deleted.');
    }

    public function getUpload()
    {
        $data = [
            'title' => 'Upload File'
        ];

        return view('students/upload', $data);
    }

    public function upload()
    {
        $student = $this->studentModel->where('email', user()->email)->first();

        $userFile = $this->request->getFile('highschool_diploma_file');

        $validationRules = [
            'highschool_diploma_file' => [
                'label' => 'Document',
                'rules' => 'uploaded[highschool_diploma_file]|mime_in[highschool_diploma_file,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[highschool_diploma_file,5120]',
                'errors' => [
                    'uploaded' => 'Please select a file to upload.',
                    'mime_in' => 'File must be in PDF format.',
                    'max_size' => 'File size must not exceed 5MB.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('modalError', true)
                ->with('validation_errors', $this->validator->getErrors());
        }

        $uploadPath = WRITEPATH . 'uploads/highschool_diploma_files/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileName = $student->student_id . "_" . date('Y-m-d_H-i-s') . "." . $userFile->getExtension();
        $userFile->move($uploadPath, $fileName);

        $data = [
            'id' => $student->id,
            'highschool_diploma_file' => $fileName
        ];

        if (!$this->studentModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->studentModel->errors());
        };

        return redirect()->to('student/profile')->with('message', 'File has been successfully uploaded.');
    }

    public function showUpload()
    {
        $filePath = $this->request->getGet('file');

        $path = WRITEPATH . 'uploads/highschool_diploma_files/' . basename($filePath);

        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $filePath . '"')
            ->setBody(file_get_contents($path));
    }

    // pie chart
    private function getCreditsByGrade($studentId = null)
    {
        $gradeCredits = $this->studentGradeModel->select('grade_letter, sum(courses.credits) as credits')
            ->join('enrollments', 'enrollments.id = enrollment_id', 'left')
            ->join('courses', 'courses.id = enrollments.course_id', 'left')
            ->where('enrollments.student_id', $studentId)
            ->groupBy('grade_letter')
            ->asArray()
            ->findAll();
        d($gradeCredits);

        $bgColors = [
            'A' => 'rgb(54, 162, 235)',
            'A-' => 'rgb(75, 192, 192)',
            'B+' => 'rgb(153, 102, 255)',
            'B' => 'rgb(255, 205, 86)',
            'B-' => 'rgb(255, 159, 64)',
            'C' => 'rgb(255, 99, 132)',
            'D' => 'rgb(255, 70, 99)'
        ];

        foreach ($gradeCredits as $row) {
            $gradeLabels[] = $row['grade_letter'] . ' = ' . $row['credits'] . ' Credits';
            $creditCounts[] = (int)$row['credits'];
            $colors[] = $bgColors[$row['grade_letter']];
        }

        return [
            'labels' => $gradeLabels,
            'datasets' => [
                [
                    'label' => 'Credits by Grade',
                    'data' => $creditCounts,
                    'bgColor' => $colors,
                    'hoverOffset' => 4
                ]
            ]
        ];
    }

    // bar chart
    private function getCreditComparison($studentId = null)
    {
        $credits = $this->enrollmentModel->select('enrollments.semester, sum(courses.credits) as credits_taken')
            ->join('courses', 'courses.id = enrollments.course_id')
            ->where('enrollments.student_id', $studentId)
            ->groupBy('enrollments.semester')
            ->asArray()
            ->findAll();
        d($credits);

        // define required credits per semester
        $creditRequiredPerSemester = [
            ['semester' => 1, 'credits_required' => 20],
            ['semester' => 2, 'credits_required' => 22],
            ['semester' => 3, 'credits_required' => 24],
            ['semester' => 4, 'credits_required' => 22],
            ['semester' => 5, 'credits_required' => 20],
            ['semester' => 6, 'credits_required' => 18]
        ];

        // convert the required credits array to an associative array with 'semester' as the key
        $creditPerSemester = array_column($creditRequiredPerSemester, null, 'semester');

        $dataCredits = array_map(function ($credit) use ($creditPerSemester) {
            $semester = $credit['semester'];
            // get the required credits for the current semester by index
            $requiredCredits = $creditPerSemester[$semester] ?? [];
            return array_merge($credit, $requiredCredits);
        }, $credits);

        foreach ($dataCredits as $row) {
            $labels[] = 'Semester ' . $row['semester'];
            $creditsTaken[] = (int)$row['credits_taken'];
            $creditsRequired[] = (int)$row['credits_required'];
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Credits Taken',
                    'data' => $creditsTaken,
                    'bgColor' => 'rgba(54,162,235,0.5)',
                    'borderColor' => 'rgb(54,162,235)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Credits Required',
                    'data' => $creditsRequired,
                    'bgColor' => 'rgb(255, 99, 132)',
                    'borderWidth' => 1,
                ]
            ]
        ];
    }

    // line chart
    private function getGpaPerSemester($studentId = null)
    {
        $dataGpa = $this->courseModel->select('sum(credits * student_grades.grade_value) / sum(credits) as semester_gpa, enrollments.semester')
            ->join('enrollments', 'enrollments.course_id = courses.id')
            ->join('student_grades', 'student_grades.enrollment_id = enrollments.id')
            ->where('enrollments.student_id', $studentId)
            ->groupBy('enrollments.semester')
            ->asArray()
            ->findAll();

        foreach ($dataGpa as $row) {
            $semesters[] = 'Semester ' . $row['semester'];
            $gpaData[] = round($row['semester_gpa'], 2);
        }

        return [
            'labels' => $semesters,
            'datasets' => [
                [
                    'label' => 'GPA',
                    'data' => $gpaData,
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'tension' => 0.1,
                    'fill' => false
                ]
            ]
        ];
    }
}
