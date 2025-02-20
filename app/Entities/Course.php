<?php

namespace App\Entities;

class Course
{
    private $kode, $nama;

    public function __construct(array $data)
    {
        $this->kode = $data['kode'] ?? '';
        $this->nama = $data['nama'] ?? '';
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
