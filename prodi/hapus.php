<?php
include '../koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM program_studi WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        echo "Gagal menghapus: " . $e->getMessage();
        exit();
    }
}

header("Location: index.php?page=home");
exit();