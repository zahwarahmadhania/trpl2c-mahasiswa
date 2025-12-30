
<?php
include '../koneksi.php';

$nim = $_GET['nim'] ?? null;

if ($nim) {
    try {
        $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE nim = :nim");
        $stmt->execute(['nim' => $nim]);
    } catch (PDOException $e) {
        echo "Gagal menghapus: " . $e->getMessage();
        exit();
    }
}

header("Location: index.php?page=home");
exit();
