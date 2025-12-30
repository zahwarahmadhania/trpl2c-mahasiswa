<?php
include("koneksi.php");
$result = mysqli_query($db, "SELECT * FROM mahasiswa ORDER BY nim");
$no = 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Daftar Mahasiswa</h2>

        <div class="mb-3">
            <a href="mahasiswa_form.php" class="btn btn-primary">+ Tambah Mahasiswa</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($data = mysqli_fetch_array($result)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($data['nim']) ?></td>
                                <td><?= htmlspecialchars($data['nama_mhs']) ?></td>
                                <td><?= date('d-m-Y', strtotime($data['tgl_lahir'])) ?></td>
                                <td><?= htmlspecialchars($data['alamat']) ? htmlspecialchars($data['alamat']) : '<i>Tidak ada</i>' ?></td>
                                <td>
                                    <a href="mahasiswa_edit.php?nim=<?= urlencode($data['nim']) ?>" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        ✏️ Edit
                                    </a>
                                    <a href="mahasiswa_hapus.php?nim=<?= urlencode($data['nim']) ?>" 
                                       class="btn btn-sm btn-danger" 
                                       title="Hapus"
                                       onclick="return confirm('Yakin hapus data <?= addslashes($data['nama_mhs']) ?>?')">
                                        🗑️ Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data mahasiswa.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>