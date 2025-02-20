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

        return view('mahasiswa/detail', ['student' => $student]);

        return view('mahasiswa/detail', ['student' => $student]);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function store()
    {
        $dataStudent = $this->request->getPost();

        $mahasiswa = new MahasiswaEntity($dataStudent);
        $this->mahasiswaModel->addStudent($mahasiswa);

        return redirect()->to('/mahasiswa');
    }

    public function update()
    {
        $dataStudent = $this->request->getPost();

        $updatedStudent = new MahasiswaEntity($dataStudent);
        $this->mahasiswaModel->updateStudent($updatedStudent);

        return redirect()->to('/mahasiswa');
    }

    public function edit($nim)
    {
        $student = $this->mahasiswaModel->getStudentByNIM($nim);

        return view('mahasiswa/update', ['student' => $student]);
    }

    public function delete($nim)
    {
        $this->mahasiswaModel->deleteStudent($nim);

        return redirect()->to('/mahasiswa');
    }
}
