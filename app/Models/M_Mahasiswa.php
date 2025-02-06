<?php

namespace App\Models;

use App\Entities\Mahasiswa;

class M_Mahasiswa
{
    private $students = [];

    public function __construct()
    {
        $this->students = [
            new Mahasiswa("1", "Kunto", "Informatika"),
            new Mahasiswa("2", "Wicaksono", "Informatika"),
        ];
    }

    public function getAllStudents()
    {
        return $this->students;
    }

    public function getStudentByNIM($nim)
    {
        foreach ($this->students as $student) {
            if ($student->getNim() === $nim) {
                return $student;
            }
        }
        return null;
    }

    public function addStudent(Mahasiswa $mahasiswa)
    {
        $this->students[] = $mahasiswa;
        return true;
    }

    public function updateStudent(Mahasiswa $mahasiswa)
    {
        foreach ($this->students as &$student) {
            if ($student->getNim() === $mahasiswa->getNim()) {
                $student = $mahasiswa;
                return true;
            }
        }
        return false;
    }

    public function deleteStudent($nim)
    {
        foreach ($this->students as $key => $student) {
            if ($student->getNim() === $nim) {
                unset($this->students[$key]);
                return true;
            }
        }
        return false;
    }
}
