<?php
include '../koneksi.php';

$pesan = '';

$title = "Tambah Data Program Studi";
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Data Program Studi</h4>
            </div>
            <div class="card-body">
                <?php if ($pesan): ?>
                    <div class="alert alert-danger"><?= $pesan ?></div>
                <?php endif; ?>

                <form method="POST" action="proses.php?aksi=tambah">
                    <div class="mb-3">
                        <label>Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control" required
                            placeholder="Contoh: Teknologi Rekayasa Perangkat Lunak">
                    </div>
                    <div class="mb-3">
                        <label>Jenjang</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="D2">
                                <label class="form-check-label">D2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="D3">
                                <label class="form-check-label">D3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="D4">
                                <label class="form-check-label">D4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="S2">
                                <label class="form-check-label">S2</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Akreditasi</label>
                        <input type="text" name="akreditas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=home" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>