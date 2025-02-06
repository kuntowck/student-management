<!DOCTYPE html>
<html>
<head>
    <title>Detail Mahasiswa</title>
</head>
<body>
    <h1>Detail Mahasiswa</h1>
    <p>NIM: <?= $student->getNim() ?></p>
    <p>Nama: <?= $student->getNama() ?></p>
    <p>Jurusan: <?= $student->getJurusan() ?></p>
    <a href="/mahasiswa">Kembali ke Daftar Mahasiswa</a>
</body>
</html>