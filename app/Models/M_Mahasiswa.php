<?php

namespace App\Models;

use App\Entities\Mahasiswa;

class M_Mahasiswa
{
    private $students = [];

    public function __construct()
    {
        $this->students = [
            new Mahasiswa(['nim' => '1', 'nama' => 'kunto', 'jurusan' => 'informatika', 'status' => 'Active',  'semester' => 7, 'ipk' => 3.50]),
            new Mahasiswa(['nim' => '2', 'nama' => 'sultan', 'jurusan' => 'informatika', 'status' => 'On Leave', 'semester' => 7, 'ipk' => 3.40]),
            new Mahasiswa(['nim' => '3', 'nama' => 'wanda', 'jurusan' => 'informatika', 'status' => 'Graduated', 'semester' => 8, 'ipk' => 3.30]),
        ];
    }

    public function getAllStudents()
    {
        return $this->students;
    }

    public function getAllStudentsArray()
    {
        $students = [];

        foreach ($this->students as $student) {
            $students[] = [
                'nim' => $student->nim,
                'nama' => $student->nama,
                'jurusan' => $student->jurusan,
                'status' => $student->status,
                'semester' => $student->semester,
                'ipk' => $student->ipk
            ];
        }

        return $students;
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

    public function getStudentArrayByNIM($nim)
    {
        $student = [];

        foreach ($this->students as $s) {
            if ($s->nim === $nim) {
                return [
                    'nim' => $s->nim,
                    'nama' => $s->nama,
                    'jurusan' => $s->jurusan,
                    'status' => $s->status,
                    'semester' => $s->semester,
                    'ipk' => $s->ipk
                ];
            }
        }

        return $student;
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
