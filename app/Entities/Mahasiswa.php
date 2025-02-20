<?php

namespace App\Entities;

class Mahasiswa
{
    private $nim, $nama, $jurusan, $status, $semester, $ipk;


    public function __construct(array $data)
    {
        $this->nim = $data['nim'] ?? '';
        $this->nama = $data['nama'] ?? '';
        $this->jurusan = $data['jurusan'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->semester = $data['semester'] ?? '';
        $this->ipk = $data['ipk'] ?? '';
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
