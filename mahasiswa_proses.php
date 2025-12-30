<?php
include("koneksi.php");

if (isset($_POST['submit'])) {
    $nim = trim($_POST['nim']);
    $nama_mhs = trim($_POST['nama_mhs']);
    $tgl_lahir = trim($_POST['tgl_lahir']);
    $alamat = trim($_POST['alamat']);

    // Validasi sederhana
    if (empty($nim) || empty($nama_mhs) || empty($tgl_lahir)) {
        die("<script>alert('NIM, Nama, dan Tanggal Lahir wajib diisi!'); window.history.back();</script>");
    }

    $sql = mysqli_query($db, 
        "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat) 
        VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat')"
    );

    if ($sql) {
        echo "<div class='alert alert-success mt-3'>Data berhasil disimpan.</div>";
        echo "<a href='mahasiswa_list.php' class='btn btn-primary'>Lihat Daftar Mahasiswa</a>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($db) . "</div>";
        echo "<a href='javascript:history.back()' class='btn btn-secondary'>Kembali</a>";
    }
}
?>