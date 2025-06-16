<?php
session_start();
include('../config/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM user WHERE user='$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        if (password_verify($password, $data['pass'])) {
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['akses'] = $data['akses'];

            // Redirect berdasarkan akses
            if ($data['akses'] == 'admin') {
                header("Location: ../pages/dashboard_admin.php");
            } elseif ($data['akses'] == 'departemen') {
                
                header("Location: ../pages/dashboard_departemen.php");
            } elseif ($data['akses'] == 'user') {
                header("Location: ../pages/dashboard_user.php");
            }
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Web Loker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login Akun</h2>

        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="user" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="pass" required>
            </div>
            <button type="submit">Masuk</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>
</body>
</html>
