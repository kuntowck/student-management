<?php

namespace App\Models;

use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table            = 'enrollments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Enrollment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'student_id', 'course_id', 'academic_year', 'semester', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'academic_year'  => 'required|integer',
        'status' => 'required|in_list[active,inactive]'
    ];
    protected $validationMessages   = [
        'academic_year' => [
            'required' => 'Academic year is required.',
            'integer'  => 'Academic year must be an integer.',
        ],
        'status'        => [
            'required' => 'Status is required.',
            'in_list'  => 'Status must be one of: active, inactive.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getEnrollmentStudentCourse($studentId)
    {
        return $this->select('enrollments.*, students.name as student_name, courses.name as course_name, courses.code as course_code, courses.credits as course_credit')
            ->join('students', 'students.student_id = enrollments.student_id', 'left')
            ->join('courses', 'courses.id = enrollments.course_id', 'left')
            ->where('enrollments.student_id', $studentId)
            ->findAll();
    }

    public function getLastEnrollment($studentId)
    {
        return $this->select('enrollments.*, courses.name as course_name, courses.code as course_code, courses.credits as course_credit')
            ->join('courses', 'courses.id = enrollments.course_id')
            ->where('student_id', $studentId)
            ->orderBy('enrollments.created_at', 'DESC')
            ->first();
    }

    public function getEnrollmentReport($search = '')
    {
        $enrollment = $this->select('enrollments.*, students.name as student_name, students.study_program, courses.name as course_name, courses.code as course_code, courses.credits as course_credit')
            ->join('students', 'students.student_id = enrollments.student_id', 'left')
            ->join('courses', 'courses.id = enrollments.course_id', 'left');

        if (!empty($search)) {
            $enrollment->groupStart()
                ->like('students.name', $search, 'both', null, true);
            // ->like('students.student_id', $search, 'both', null, true);
            if (is_numeric($search)) {
                $enrollment->orWhere('students.student_id', $search);
            }
            $enrollment->groupEnd();
        }

        return $enrollment->findAll();
    }
}
