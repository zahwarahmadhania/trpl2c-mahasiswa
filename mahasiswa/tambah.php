<?php
include '../koneksi.php';

$pesan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

$title = "Tambah Data Mahasiswa";
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <?php if ($pesan): ?>
                    <div class="alert alert-danger"><?= $pesan ?></div>
                <?php endif; ?>

                <form method="POST" action="proses.php?aksi=tambah">
                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required placeholder="Contoh: 2024001">
                    </div>
                    <div class="mb-3">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama_mhs" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" required>
                    </div>
                    <!-- Program Studi -->
                    <div class="mb-3">
                        <label>Program Studi</label>
                        <select name="program_studi_id" class="form-select">
                            <option value="">-- Pilih Program Studi --</option>
                            <?php
                            $sql = "SELECT * FROM program_studi";
                            $stmt = $pdo->query($sql);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nama_prodi'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=home" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>