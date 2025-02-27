<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Student extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $attributes = [
        'student_id' => null,
        'name' => null,
        'study_program' => null,
        'current_semester' => null,
        'academic_status' => null,
        'entry_year' => null,
        'gpa' => null,
    ];
}
