<?php

use App\Entitites\Mahasiswa;

class M_Mahasiswa extends Mahasiswa
{
    private $students = [];

    public function getAllStudents()
    {
        return $this->students;
    }

    public function getStudentByNim($nim)
    {
        foreach ($this->students as $student) {
            if ($student->getNim() === $nim) {
                return $student;
            }
        }
    }

    public function addStudent(Mahasiswa $mahasiswa)
    {
        $this->students = $mahasiswa;
    }

    public function updateStudent(Mahasiswa $mahasiswa)
    {
        foreach ($this->students as $student) {
            if ($student->getNim() === $mahasiswa->getNim()) {
                $student = $mahasiswa;
            }
        }
    }

    public function deleteStudent($nim)
    {
        foreach ($this->students as $student) {
            if ($student->getNim() === $nim) {
                unset($student);
            }
        }
    }
}
