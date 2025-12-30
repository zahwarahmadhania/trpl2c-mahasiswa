<?php
include '../koneksi.php';

$aksi = $_GET['aksi'] ?? '';

if ($aksi == 'tambah' && $_SERVER["REQUEST_METHOD"] == "POST") {

    $nim    = $_POST['nim'] ?? '';
    $nama   = $_POST['nama_mahasiswa'] ?? '';
    $tgl    = $_POST['tgl_lahir'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $prodi  = $_POST['program_studi_id'] ?? '';

    // Validasi tanggal
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl)) {
        die('Format tanggal lahir tidak valid');
    }

    try {
        $sql = "INSERT INTO mahasiswa 
                (nim, nama_mahasiswa, tgl_lahir, program_studi_id, alamat)
                VALUES (:nim, :nama, :tgl, :prodi, :alamat)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nim'    => $nim,
            'nama'   => $nama,
            'tgl'    => $tgl,
            'prodi'  => $prodi,
            'alamat' => $alamat
        ]);

        header("Location: index.php?page=home");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
