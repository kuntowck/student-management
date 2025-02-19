<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>
</head>

<body>
    <h1>Edit Mahasiswa</h1>
    <form method="post" action="/mahasiswa/update/<?= $student->nim; ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" value="<?= $student->nim ?>" readonly><br>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= $student->nama ?>" required><br>
        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" value="<?= $student->jurusan ?>" required><br>
        <label for="semester">Semester:</label>
        <input type="text" id="semester" name="semester" value="<?= $student->semester ?>" required><br>
        <label for="ipk">IPK:</label>
        <input type="text" id="ipk" name="ipk" value="<?= $student->ipk ?>" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="/mahasiswa">Kembali ke Daftar Mahasiswa</a>
</body>

</html>