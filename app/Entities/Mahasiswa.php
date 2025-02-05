<?php

namespace App\Entitites;

class Mahasiswa
{
    private $nim, $nama, $jurusan;

    public function __construct($nim, $nama, $jurusan)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->jurusan = $jurusan;
    }

    public function getNim()
    {
        return $this->nim;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getJurusan()
    {
        return $this->jurusan;
    }

    public function getFullInfo()
    {
        return "NIM: {$this->nim}, Nama: {$this->nama}, Jurusan: {$this->jurusan}";
    }
}
