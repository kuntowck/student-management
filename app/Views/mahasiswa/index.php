<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>
    <a href="/mahasiswa/create">Tambah Mahasiswa</a>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student->getNim() ?></td>
                <td><?= $student->getNama() ?></td>
                <td><?= $student->getJurusan() ?></td>
                <td>
                    <a href="/mahasiswa/detail/<?= $student->getNim() ?>">Detail</a>
                    <a href="/mahasiswa/update/<?= $student->getNim() ?>">Edit</a>
                    <a href="/mahasiswa/delete/<?= $student->getNim() ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>