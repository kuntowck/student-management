<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Enrollment extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $attributes = [
        'code' => null,
        'name' => null,
        'credits' => null,
        'semester' => null,
    ];
}
