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
            <th>Semester</th>
            <th>IPK</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student->nim ?></td>
                <td><?= $student->nama ?></td>
                <td><?= $student->jurusan ?></td>
                <td><?= $student->semester ?></td>
                <td><?= $student->ipk ?></td>
                <td>
                    <a href="/mahasiswa/detail/<?= $student->nim ?>">Detail</a>
                    <a href="/mahasiswa/update/<?= $student->nim ?>">Edit</a>
                    <form action="/mahasiswa/delete/<?= $student->nim ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit" onclick="return confirm('Are you sure?')">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>