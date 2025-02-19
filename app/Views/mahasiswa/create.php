<!DOCTYPE html>
<html>

<head>
    <title>Tambah Mahasiswa</title>
</head>

<body>
    <h1>Tambah Mahasiswa</h1>
    <form method="post" action="/mahasiswa/create">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required><br>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>
        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" required><br>
        <label for="semester">Semester:</label>
        <input type="text" id="semester" name="semester" required><br>
        <label for="ipk">IPK:</label>
        <input type="text" id="ipk" name="ipk" required><br>
        <button type="submit">Tambah</button>
    </form>
    <a href="/mahasiswa">Kembali ke Daftar Mahasiswa</a>
</body>

</html>