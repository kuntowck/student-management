<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>
</head>

<body>
    <h1>Edit Mahasiswa</h1>
    <form method="post" action="/mahasiswa/update/<?= $student->getNim() ?>">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" value="<?= $student->getNim() ?>" readonly><br>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= $student->getNama() ?>" required><br>
        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" value="<?= $student->getJurusan() ?>" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="/mahasiswa">Kembali ke Daftar Mahasiswa</a>
</body>

</html>