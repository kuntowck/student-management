<?php

namespace App\Models;

use App\Entities\Mahasiswa;

class M_Mahasiswa
{
    private $students = [];

    public function __construct()
    {
        $this->students = [
            new Mahasiswa(['nim' => '1', 'nama' => 'kunto', 'jurusan' => 'informatika', 'semester' => 7, 'ipk' => 3.50]),
            new Mahasiswa(['nim' => '2', 'nama' => 'sultan', 'jurusan' => 'informatika', 'semester' => 7, 'ipk' => 3.40]),

        ];
    }

    public function getAllStudents()
    {
        return $this->students;
    }

    public function getStudentByNIM($nim)
    {
        foreach ($this->students as $student) {
            if ($student->nim === $nim) {
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
            if ($student->nim === $mahasiswa->nim) {
                $student = $mahasiswa;
                return true;
            }
        }
        return false;
    }

    public function deleteStudent($nim)
    {
        foreach ($this->students as $key => $student) {
            if ($student->nim === $nim) {
                unset($this->students[$key]);
                return true;
            }
        }
        return false;
    }
}
