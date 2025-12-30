<?php
<<<<<<< HEAD
$host = 'localhost';
$database = 'db-akademik';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$database;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
=======
// Koneksi ke database MySQL menggunakan mysqli
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "db_akademik";

$db = mysqli_connect($server, $user, $password, $nama_database);

// Cek koneksi
if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
?>
>>>>>>> 7394782e33adbcf79df3ef5bf41f27e6dbc63f2b
