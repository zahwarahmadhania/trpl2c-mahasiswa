<?php
include("koneksi.php");

if (!isset($_GET['nim']) || empty($_GET['nim'])) {
    die("<script>alert('NIM tidak valid'); window.location='mahasiswa_list.php';</script>");
}

$nim = $_GET['nim'];
$result = mysqli_query($db, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
if (mysqli_num_rows($result) == 0) {
    die("<div class='alert alert-warning m-4'>Data tidak ditemukan.</div>");
}
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h3 class="mb-0">Edit Data Mahasiswa</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="nim_lama" value="<?= htmlspecialchars($data['nim']) ?>">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" 
                               value="<?= htmlspecialchars($data['nim']) ?>" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs"
                               value="<?= htmlspecialchars($data['nama_mhs']) ?>" maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                               value="<?= $data['tgl_lahir'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= htmlspecialchars($data['alamat']) ?></textarea>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="mahasiswa_list.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $nim_baru   = trim($_POST['nim']);
        $nama_mhs   = trim($_POST['nama_mhs']);
        $tgl_lahir  = trim($_POST['tgl_lahir']);
        $alamat     = trim($_POST['alamat']);
        $nim_lama   = $_POST['nim_lama'];

        if (empty($nim_baru) || empty($nama_mhs) || empty($tgl_lahir)) {
            echo "<script>alert('NIM, Nama, dan Tanggal Lahir wajib diisi!');</script>";
        } else {
            $update = mysqli_query($db, 
                "UPDATE mahasiswa 
                 SET nim='$nim_baru', nama_mhs='$nama_mhs', tgl_lahir='$tgl_lahir', alamat='$alamat'
                 WHERE nim='$nim_lama'"
            );

            if ($update) {
                echo "<script>alert('Data berhasil diupdate'); window.location='mahasiswa_list.php';</script>";
            } else {
                echo "<div class='alert alert-danger m-4'>Gagal update: " . mysqli_error($db) . "</div>";
            }
        }
    }
    ?>
</body>
</html>