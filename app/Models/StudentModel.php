<?php

namespace App\Models;

use App\Libraries\DataParams;
use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Student::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_id',
        'email',
        'name',
        'study_program',
        'current_semester',
        'academic_status',
        'entry_year',
        'gpa'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'student_id'       => 'required|is_unique[students.student_id,id,{id}]',
        'email'            => 'required|is_unique[students.email]',
        'current_semester' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[14]',
        'gpa'              => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[4.00]',
        'academic_status'  => 'required|in_list[active,on leave,graduated]',
    ];
    protected $validationMessages   = [
        'student_id' => [
            'required'  => 'Student ID is required.',
            'is_unique' => 'Student ID must be unique.',
        ],
        'email' => [
            'required'  => 'Email is required.',
            'is_unique' => 'Email must be unique.',
        ],
        'current_semester' => [
            'required' => 'Semester is required.',
            'integer'  => 'Semester must be a number.',
            'greater_than_equal_to' => 'Semester must be at least 1.',
            'less_than_equal_to'    => 'Semester must be at most 14.',
        ],
        'gpa' => [
            'required' => 'GPA is required.',
            'decimal'  => 'GPA must be a decimal number.',
            'greater_than_equal_to' => 'GPA must be at least 0.',
            'less_than_equal_to'    => 'GPA must be at most 4.00.',
        ],
        'academic_status' => [
            'required' => 'Academic status is required.',
            'in_list'  => 'Academic status must be one of: active, on leave, graduated.',
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

    public function getAllStudentsArray()
    {
        $students = $this->findAll();
        $studentsArr = [];

        foreach ($students as $student) {
            $studentsArr[] = $student->toArray();
        }

        return $studentsArr;
    }

    public function getStudentArrayByID($id)
    {
        $student = $this->find($id);

        return $student->toArray();
    }

    public function getFilteredStudents(DataParams $params)
    {
        // Apply search
        if (!empty($params->search)) {
            $this->groupStart()
                ->like('student_id', $params->search, 'both', null, true)
                ->orLike('name', $params->search, 'both', null, true)
                ->orLike('study_program', $params->search, 'both', null, true)
                ->orLike('academic_status', $params->search, 'both', null, true);
            if (is_numeric($params->search)) {
                $this->orWhere('CAST (student_id AS TEXT) LIKE', "%$params->search%")
                    ->orWhere('CAST (current_semester AS TEXT) LIKE', "%$params->search%")
                    ->orWhere('CAST (gpa AS TEXT) LIKE', "%$params->search%")
                    ->orWhere('CAST (entry_year AS TEXT) LIKE', "%$params->search%");
            }
            $this->groupEnd();
        }

        // Apply study program filter
        if (!empty($params->studyProgram)) {
            $this->where('study_program', $params->studyProgram);
        }

        // Apply status filter
        if (!empty($params->status)) {
            $this->where('academic_status', $params->status);
        }

        // Apply entry year filter 
        if (!empty($params->entryYear)) {
            $this->where('entry_year', $params->entryYear);
        }

        // Apply sort
        $allowedSortColumns = ['id', 'student_id', 'name', 'study_program', 'academic_status', 'entry_year', 'gpa'];
        $sort = in_array($params->sort, $allowedSortColumns) ? $params->sort : 'id';
        $order = ($params->order === 'desc') ? 'desc' : 'asc';

        $this->orderBy($sort, $order);

        $result = [
            'students' => $this->paginate($params->perPage, 'students', $params->page),
            'pager' => $this->pager,
            'total' => $this->countAllResults(false)
        ];
        return $result;
    }

    public function getTotalStudents()
    {
        return $this->countAllResults();
    }

    public function getAllStudyProgram()
    {
        $programs = $this->select('study_program')->distinct()->findAll();

        return array_column($programs, 'study_program');
    }

    public function getAllStatus()
    {
        $statuses = $this->select('academic_status')->distinct()->findAll();

        return array_column($statuses, 'academic_status');
    }

    public function getAllEntryYear()
    {
        $entryYears = $this->select('entry_year')->distinct()->findAll();

        return array_column($entryYears, 'entry_year');
    }
}
