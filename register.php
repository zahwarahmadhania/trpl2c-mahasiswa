<?php
session_start();

$error = null;

if (isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);


    require 'koneksi.php';

    try {
        // cek apakah email sudah ada
        $sql = "SELECT * FROM pengguna WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
        ]);
        $cekEmail = $stmt->fetchAll();
        if ($cekEmail) {
            $error = "Email sudah terdaftar";
        } else {
            $sql = "INSERT INTO pengguna (nama_lengkap, email, password) VALUES (:name, :email, :pass)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'pass' => $pass,
            ]);
            header('Location: login.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ((isset($_SESSION['login']))) {
    header('Location: index.php');
} else {

?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registerasi - Sistem Pencatatan Data Mahasiswa</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="bg-light d-flex flex-column min-vh-100">
        <div class="card m-auto" style="width: 22rem;">
            <div class="card-body">
                <h2 class="text-center mb-4">Registerasi</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <div class="mt-4">
                    <?php
                    if ($error) {
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                    }
                    ?>
                </div>
                <div class="mt-4">
                    <p>Sudah memiliki akun? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </body>
    </html>
<?php
}
?>
