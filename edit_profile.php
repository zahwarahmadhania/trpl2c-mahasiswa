<?php
session_start(); // Posisi session_start wajib paling atas

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$title = "Profile - Sistem Pencatatan Data Mahasiswa";
include 'koneksi.php';
include 'layout/header.php';

if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $password_lama = md5($_POST['password_lama']);
    
    $password_baru_input = $_POST['password_baru'];

    $sql = "SELECT * FROM pengguna WHERE id = :id AND password = :pass";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id' => $id,
        'pass' => $password_lama,
    ]);
    $user = $stmt->fetch();

    if ($user) {
        if (!empty($password_baru_input)) {
            $password_baru_hash = md5($password_baru_input);
            $sql = "UPDATE pengguna SET nama_lengkap = :nama_lengkap, password = :pass WHERE id = :id";
            $params = [
                'nama_lengkap' => $nama_lengkap,
                'pass' => $password_baru_hash,
                'id' => $id,
            ];
        } else {
            $sql = "UPDATE pengguna SET nama_lengkap = :nama_lengkap WHERE id = :id";
            $params = [
                'nama_lengkap' => $nama_lengkap,
                'id' => $id,
            ];
        }

        $stmt = $pdo->prepare($sql);
        $berhasil = $stmt->execute($params);

        if ($berhasil) {
            $_SESSION['nama_lengkap'] = $nama_lengkap;
            echo "<script>alert('Data berhasil diubah.'); window.location='edit_profile.php';</script>";
        }
    } else {
        echo "<script>alert('Password lama salah. Perubahan gagal.');</script>";
    }
}
?>

<div class="container py-4">
    <div class="mb-4">
        <h1 class="text-center">Edit Profile</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($_SESSION['nama_lengkap']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" required>
                            <small class="text-muted">Masukkan password lama untuk konfirmasi.</small>
                        </div>
                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="password_baru" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'layout/footer.php';
?>