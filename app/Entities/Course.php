<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Course extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $attributes = [
        'academic_year' => null,
        'status' => null
    ];
}
