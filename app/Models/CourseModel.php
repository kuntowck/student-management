<?php

namespace App\Models;

use App\Libraries\DataParams;
use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Course::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'code', 'name', 'credits', 'semester'];

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
        'code'     => 'required|exact_length[3]',
        'credits'  => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[6]',
        'semester' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[8]',
    ];
    protected $validationMessages   = [
        'code' => [
            'required'    => 'Course code is required.',
            'exact_length' => 'Course code must be exactly 3 characters long.',
        ],
        'credits' => [
            'required' => 'Course credits are required.',
            'integer'  => 'Course credits must be a number.',
            'greater_than_equal_to' => 'Course credits must be at least 1.',
            'less_than_equal_to'    => 'Course credits must be at most 6.',
        ],
        'semester' => [
            'required' => 'Semester is required.',
            'integer'  => 'Semester must be a number.',
            'greater_than_equal_to' => 'Semester must be at least 1.',
            'less_than_equal_to'    => 'Semester must be at most 8.',
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

    public function getAllCoursesArray()
    {
        $courses = $this->findAll();
        $coursesArr = [];

        foreach ($courses as $course) {
            $coursesArr[] = $course->toArray();
        }

        return $coursesArr;
    }

    public function getCourseArrayByID($id)
    {
        $course = $this->find($id);

        return $course->toArray();
    }

    public function getFilteredCourses(DataParams $params)
    {
        // Apply search
        if (!empty($params->search)) {
            $this->groupStart()
                ->Like('name', $params->search, 'both', null, true);

            if (is_numeric($params->search)) {
                $this->orWhere('CAST (code AS TEXT) LIKE', "%$params->search%")
                    ->orWhere('CAST (credits AS TEXT) LIKE', "%$params->search%")
                    ->orWhere('CAST (semester AS TEXT) LIKE', "%$params->search%");
            }
            $this->groupEnd();
        }

        // Apply credits filter
        if (!empty($params->credits)) {
            $this->where('credits', $params->credits);
        }

        // Apply semester filter
        if (!empty($params->semester)) {
            $this->where('semester', $params->semester);
        }

        // Apply sort
        $allowedSortColumns = ['id', 'code', 'name', 'credits', 'semester'];
        $sort = in_array($params->sort, $allowedSortColumns) ? $params->sort : 'id';
        $order = ($params->order === 'desc') ? 'desc' : 'asc';

        $this->orderBy($sort, $order);

        $result = [
            'courses' => $this->paginate($params->perPage, 'courses', $params->page),
            'pager' => $this->pager,
            'total' => $this->countAllResults(false)
        ];
        return $result;
    }

    public function getAllCredits()
    {
        $credits = $this->select('credits')->distinct()->findAll();

        return array_column($credits, 'credits');
    }

    public function getAllSemesters()
    {
        $semesters = $this->select('semester')->distinct()->findAll();

        return array_column($semesters, 'semester');
    }
}
