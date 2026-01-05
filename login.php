<?php
session_start();

if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sistem Akademik</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

<div class="card shadow-sm p-4" style="width: 100%; max-width: 380px;">
    <div class="text-center mb-4">
        <i class="bi bi-person-circle fs-1 text-primary"></i>
        <h4 class="fw-bold mt-2">Login</h4>
        <p class="text-muted mb-0">Sistem Pencatatan Data Mahasiswa</p>
    </div>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" name="password" id="password" class="form-control" required>
                <span class="input-group-text" style="cursor:pointer" onclick="togglePassword()">
                    <i class="bi bi-eye" id="eye"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-semibold">
            Masuk
        </button>
    </form>

    <div class="text-center mt-3">
        <small>
            Belum punya akun?
            <a href="register.php" class="text-decoration-none fw-semibold">Daftar</a>
        </small>
    </div>

    <?php
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $pass = md5($_POST['password']);

        require 'koneksi.php';

        try {
            $sql = "SELECT id, nama_lengkap FROM pengguna WHERE email = :email AND password = :pass";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'pass' => $pass,
            ]);

            $cekLogin = $stmt->fetch();

            if ($cekLogin) {
                $_SESSION['id'] = $cekLogin['id'];
                $_SESSION['login'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['nama_lengkap'] = $cekLogin['nama_lengkap'];
                header('Location: index.php');
                exit();
            } else {
                echo '<div class="alert alert-danger mt-3 text-center">Email atau password salah</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger mt-3">'.$e->getMessage().'</div>';
        }
    }
    ?>
</div>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    const eye = document.getElementById("eye");
    if (pass.type === "password") {
        pass.type = "text";
        eye.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        pass.type = "password";
        eye.classList.replace("bi-eye-slash", "bi-eye");
    }
}
</script>

</body>
</html>
