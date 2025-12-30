
<?php
$title = "Beranda - Sistem Pencatatan Data Mahasiswa";
include 'layout/header.php';

session_start();

if (!(isset($_SESSION['login']))) {
    header('Location: login.php');
} else {

?>
    <div class="container py-4">
        <div class="mb-4">
            <h1 class="display-5 fw-bold text-primary">Sistem Pencatatan Data Mahasiswa</h1>
        </div>

        <div class="mb-2">
            <!-- Selamat datang admin -->
            <p>Selamat datang, <?= $_SESSION['nama_lengkap']; ?>!</p>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6 mb-4">
                <div class="h-100 p-5 text-white bg-dark rounded-3 shadow-sm">
                    <h2 class="fw-bold">Data Mahasiswa</h2>
                    <p>Kelola seluruh data mahasiswa, mulai dari informasi pribadi hingga data akademik. Anda dapat
                        menambah, mengubah, dan menghapus data mahasiswa dengan mudah.</p>
                    <a href="mahasiswa/index.php" class="btn btn-outline-light" type="button">Kelola Mahasiswa</a>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="h-100 p-5 bg-white border rounded-3 shadow-sm">
                    <h2 class="fw-bold">Data Program Studi</h2>
                    <p>Informasi lengkap mengenai program studi yang tersedia. Kelola data fakultas dan jurusan sebagai
                        referensi data mahasiswa.</p>
                    <a href="prodi/index.php" class="btn btn-outline-secondary" type="button">Kelola Prodi</a>
                </div>
            </div>
        </div>


    </div>
<?php
}
include 'layout/footer.php';
?>
