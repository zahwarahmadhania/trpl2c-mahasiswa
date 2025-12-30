<?php
include '../koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?page=home");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM program_studi WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch();

if (!$data) {
    die("Data tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

$title = "Edit Data Program Studi";
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary">
                <h4 class="mb-0">Edit Data Program Studi</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="proses.php?aksi=edit">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-3">
                        <label>Nama Program Studi</label>
                        <input type="text" name="nama_prodi" class="form-control"
                            value="<?= htmlspecialchars($data['nama_prodi']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Jenjang</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="D2"
                                    <?= $data['jenjang'] == 'D2' ? 'checked' : '' ?>>
                                <label class="form-check-label">D2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="D3"
                                    <?= $data['jenjang'] == 'D3' ? 'checked' : '' ?>>
                                <label class="form-check-label">D3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="D4"
                                    <?= $data['jenjang'] == 'D4' ? 'checked' : '' ?>>
                                <label class="form-check-label">D4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenjang" value="S2"
                                    <?= $data['jenjang'] == 'S2' ? 'checked' : '' ?>>
                                <label class="form-check-label">S2</label>
                            </div>
                        </div>
                        <div class="form-check">
                        </div>
                        <div class="mb-3">
                            <label>Akreditas</label>
                            <textarea name="akreditas" class="form-control"
                                rows="3"><?= htmlspecialchars($data['akreditas']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"
                                rows="3"><?= htmlspecialchars($data['keterangan']) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="index.php?page=home" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>