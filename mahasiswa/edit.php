<?php
include '../koneksi.php';

$nim = $_GET['nim'] ?? null;

if (!$nim) {
    header("Location: index.php?page=home");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
$stmt->execute(['nim' => $nim]);
$data = $stmt->fetch();

if (!$data) {
    die("Data tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

$title = "Edit Data Mahasiswa";
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white">Edit Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="proses.php?aksi=edit">
                    <div class="mb-3">
                        <label>NIM (Tidak bisa diubah)</label>
                        <input type="text" name="nim" class="form-control bg-light"
                            value="<?= htmlspecialchars($data['NIM']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" class="form-control"
                            value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>"
                            required>
                    </div>
                    <!-- Program Studi -->
                    <div class="mb-3">
                        <label>Program Studi</label>
                        <select name="program_studi_id" class="form-select" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <?php
                            $stmt = $pdo->query("SELECT id, nama_prodi FROM program_studi");
                            while ($row = $stmt->fetch()) {
                                echo "<option value='{$row['id']}'>{$row['nama_prodi']}</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"
                            rows="3"><?= htmlspecialchars($data['alamat']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="index.php?page=home" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>