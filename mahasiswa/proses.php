<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}
include '../koneksi.php';

$aksi = $_GET['aksi'] ?? '';

if ($aksi == 'tambah' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    // Pastikan nama variabel di sini sama dengan yang di execute
    $nama_mahasiswa = $_POST['nama_mhs'] ?? $_POST['nama_mahasiswa'] ?? '';
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $program_studi_id = $_POST['program_studi_id'];

    try {
        $sql = "INSERT INTO mahasiswa (nim, nama_mahasiswa, tgl_lahir, program_studi_id, alamat, pengguna_id) 
                VALUES (:nim, :nama, :tgl, :prodi, :alamat, :pengguna_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nim' => $nim,
            'nama' => $nama_mahasiswa, // Sekarang variabel ini sudah ada isinya
            'tgl' => $tgl_lahir,
            'prodi' => $program_studi_id,
            'alamat' => $alamat,
            'pengguna_id' => $_SESSION['id']
        ]);

        header("Location: index.php?page=home");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

} elseif ($aksi == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $program_studi_id = $_POST['program_studi_id'];
    $alamat = $_POST['alamat'];

    try {
        $sql = "UPDATE mahasiswa SET 
                nama_mahasiswa = :nama, 
                tgl_lahir = :tgl, 
                program_studi_id = :prodi, 
                alamat = :alamat 
                WHERE nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nama' => $nama_mahasiswa,
            'tgl' => $tgl_lahir,
            'prodi' => $program_studi_id,
            'alamat' => $alamat,
            'nim' => $nim
        ]);

        header("Location: index.php?page=home");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

} elseif ($aksi == 'hapus') {
    $nim = $_GET['nim'] ?? null;
    if ($nim) {
        try {
            $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE nim = :nim");
            $stmt->execute(['nim' => $nim]);
        } catch (PDOException $e) {
            die("Gagal menghapus: " . $e->getMessage());
        }
    }
    header("Location: index.php?page=home");
    exit();
} else {
    header("Location: index.php?page=home");
    exit();
}