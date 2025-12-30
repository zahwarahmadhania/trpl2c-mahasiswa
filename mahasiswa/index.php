<?php
include '../koneksi.php';

$sql = "SELECT mahasiswa.*, program_studi.nama_prodi 
        FROM mahasiswa 
        LEFT JOIN program_studi 
        ON mahasiswa.program_studi_id = program_studi.id";
$stmt = $pdo->query($sql);
$mahasiswa = $stmt->fetchAll();

$title = "Daftar Mahasiswa";
include '../layout/header.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'tambah':
        include 'tambah.php';
        break;
    case 'edit':
        include 'edit.php';
        break;
    case 'hapus':
        include 'hapus.php';
        break;
    default:
        include 'home.php';
        break;
}

include '../layout/footer.php';
