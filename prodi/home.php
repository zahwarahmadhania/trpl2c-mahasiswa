<?php
include '../koneksi.php';

$stmt = $pdo->query('SELECT * FROM program_studi');
$prodi = $stmt->fetchAll();

$title = "Daftar Program Studi";
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Program Studi</h4>
        <a href="index.php?page=tambah" class="btn btn-light btn-sm fw-bold">Tambah Data</a>
    </div>
    <div class="card-body">
        <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?= htmlspecialchars($_GET['message'] ?? 'Terjadi kesalahan.') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Program Studi</th>
                        <th>Jenjang</th>
                        <th>Akreditasi</th>
                        <th>Keterangan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($prodi) > 0): ?>
                        <?php foreach ($prodi as $prd): ?>
                            <tr>
                                <td><?= $prd['nama_prodi'] ?></td>
                                <td><?= $prd['jenjang'] ?></td>
                                <td><?= $prd['akreditasi'] ?></td>
                                <td><?= $prd['keterangan'] ?></td>
                                <td>
                                    <a href="edit.php?page=edit&id=<?= $prd['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="proses.php?aksi=hapus&id=<?= $prd['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data prodi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>