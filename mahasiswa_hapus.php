<?php
include("koneksi.php");

if (isset($_GET['nim']) && !empty($_GET['nim'])) {
    $nim = $_GET['nim'];
    $hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE nim = '$nim'");
    
    if ($hapus) {
        header("Location: mahasiswa_list.php?pesan=deleted");
        exit;
    } else {
        die("<script>alert('Gagal menghapus data: " . mysqli_error($db) . "'); window.history.back();</script>");
    }
} else {
    die("<script>alert('NIM tidak ditemukan'); window.location='mahasiswa_list.php';</script>");
}
?>