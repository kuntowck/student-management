<?php

namespace App\Controllers;

use App\Models\M_Mahasiswa;
use App\Entities\Mahasiswa as MahasiswaEntity;

class Mahasiswa extends BaseController
{
    private $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new M_Mahasiswa();
    }

    public function index()
    {
        $students = $this->mahasiswaModel->getAllStudents();
        return view('mahasiswa/index', ['students' => $students]);
    }

    public function detail($nim)
    {
        $student = $this->mahasiswaModel->getStudentByNIM($nim);
        if ($student) {
            return view('mahasiswa/detail', ['student' => $student]);
        } else {
            return redirect()->to('/mahasiswa');
        }
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $nim = $this->request->getPost('nim');
            $nama = $this->request->getPost('nama');
            $jurusan = $this->request->getPost('jurusan');

            $mahasiswa = new MahasiswaEntity($nim, $nama, $jurusan);
            $this->mahasiswaModel->addStudent($mahasiswa);

            return redirect()->to('/mahasiswa');
        }

        return view('mahasiswa/create');
    }

    public function update($nim)
    {
        $student = $this->mahasiswaModel->getStudentByNIM($nim);
        if (!$student) {
            return redirect()->to('/mahasiswa');
        }

        if ($this->request->getMethod() === 'post') {
            $nama = $this->request->getPost('nama');
            $jurusan = $this->request->getPost('jurusan');

            $updatedStudent = new MahasiswaEntity($nim, $nama, $jurusan);
            $this->mahasiswaModel->updateStudent($updatedStudent);

            return redirect()->to('/mahasiswa');
        }

        return view('mahasiswa/update', ['student' => $student]);
    }

    public function delete($nim)
    {
        $this->mahasiswaModel->deleteStudent($nim);
        return redirect()->to('/mahasiswa');
    }
}
