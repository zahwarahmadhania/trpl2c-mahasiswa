<?php
include '../koneksi.php';

// Pastikan parameter yang digunakan adalah 'id' sesuai kebutuhan tabel prodi
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?page=home");
    exit();
}

// Ambil data lama
$stmt = $pdo->prepare("SELECT * FROM program_studi WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch();

if (!$data) {
    die("Data tidak ditemukan.");
}

$title = "Edit Data Program Studi";
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary py-3">
                <h5 class="mb-0 text-white fw-bold">Edit Data Program Studi</h5>
            </div>
            
            <div class="card-body p-4">
                <form method="POST" action="proses.php?aksi=edit">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" class="form-control"
                               value="<?= htmlspecialchars($data['nama_prodi'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Jenjang</label>
                        <div class="d-flex gap-4 mt-1">
                            <?php 
                            $options = ['D2', 'D3', 'D4', 'S2'];
                            foreach($options as $opt): 
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" id="j<?= $opt ?>" value="<?= $opt ?>"
                                    <?= ($data['jenjang'] ?? '') == $opt ? 'checked' : '' ?> required>
                                <label class="form-check-label" for="j<?= $opt ?>"><?= $opt ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Akreditasi</label>
                        <textarea name="akreditasi" class="form-control" rows="3"><?= htmlspecialchars($data['akreditasi'] ?? $data['akreditas'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($data['keterangan'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">Update</button>
                        <a href="index.php?page=home" class="btn btn-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>