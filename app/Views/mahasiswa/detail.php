<!DOCTYPE html>
<html>

<head>
    <title>Detail Mahasiswa</title>
</head>

<body>
    <h1>Detail Mahasiswa</h1>
    <p>NIM: <?= $student->nim ?></p>
    <p>Nama: <?= $student->nama ?></p>
    <p>Jurusan: <?= $student->jurusan ?></p>
    <p>Semester: <?= $student->semester ?></p>
    <p>IPK: <?= $student->ipk ?></p>
    <a href="/mahasiswa">Kembali ke Daftar Mahasiswa</a>
</body>

</html>