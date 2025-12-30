<?php
include '../koneksi.php';

$aksi = $_GET['aksi'] ?? '';

if ($aksi == 'tambah') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_prodi = $_POST['nama_prodi'];
        $jenjang = $_POST['jenjang'];
        $akreditas = $_POST['akreditas'];
        $keterangan = $_POST['keterangan'];

        try {
            $sql = "INSERT INTO program_studi (nama_prodi, jenjang, akreditas, keterangan) VALUES (:nama_prodi, :jenjang, :akreditas, :keterangan)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nama_prodi' => $nama_prodi,
                'jenjang' => $jenjang,
                'akreditas' => $akreditas,
                'keterangan' => $keterangan
            ]);

            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} elseif ($aksi == 'edit') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nama_prodi = $_POST['nama_prodi'];
        $jenjang = $_POST['jenjang'];
        $akreditas = $_POST['akreditas'];
        $keterangan = $_POST['keterangan'];

        try {
            $sql = "UPDATE program_studi SET nama_prodi = :nama_prodi, jenjang = :jenjang, akreditas = :akreditas, keterangan = :keterangan WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nama_prodi' => $nama_prodi,
                'jenjang' => $jenjang,
                'akreditas' => $akreditas,
                'keterangan' => $keterangan,
                'id' => $id
            ]);

            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} elseif ($aksi == 'hapus') {
    $id = $_GET['id'] ?? null;

    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM program_studi WHERE id = :id");
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                header("Location: index.php?status=error&message=" . urlencode("Gagal menghapus: Data prodi ini sedang digunakan oleh mahasiswa."));
                exit();
            } else {
                echo "Gagal menghapus: " . $e->getMessage();
                exit();
            }
        }
    }
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}