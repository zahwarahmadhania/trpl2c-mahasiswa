<?php
session_start();

if ((isset($_SESSION['login']))) {
    header('Location: index.php');
} else {

?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Sistem Pencatatan Data Mahasiswa</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="bg-light d-flex flex-column min-vh-100">
        <div class="card m-auto" style="width: 22rem;">
            <div class="card-body">
                <h2 class="text-center mb-4">Login</h2>
                <form method="POST">
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
                    <p>Belum memiliki akun? <a href="register.php">Buat akun</a></p>
                </div>
                <?php

                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                    $pass = md5($_POST['password']);

                    require 'koneksi.php';

                    try {
                        $sql = "SELECT nama_lengkap FROM pengguna WHERE email = :email AND password = :pass";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            'email' => $email,
                            'pass' => $pass,
                        ]);
                        $cekLogin = $stmt->fetchAll();

                        if ($cekLogin) {
                            // set session
                            session_start();
                            $_SESSION['login'] = true;
                            $_SESSION['email'] = $email;
                            $_SESSION['nama_lengkap'] = $cekLogin[0]['nama_lengkap'];
                            header('Location: index.php');
                            exit();
                        } else {
                            echo '<div class="alert alert-danger">Email atau password salah</div>';
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }

                ?>
            </div>
        </div>
    </body>

    </html>

<?php
}
?>