<?php
include('../config/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE user='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query_user = "INSERT INTO user (user, pass, akses) VALUES ('$username', '$password_hash', 'user')";
        $insert_user = mysqli_query($koneksi, $query_user);

        if ($insert_user) {
            $id_user = mysqli_insert_id($koneksi); // ambil ID terakhir
            $query_pelamar = "INSERT INTO pelamar (id_user, nama, email, no_hp, alamat) 
                              VALUES ('$id_user', '$nama', '$email', '$no_hp', '$alamat')";
            $insert_pelamar = mysqli_query($koneksi, $query_pelamar);

            if ($insert_pelamar) {
                $success = "Pendaftaran berhasil. Silakan login.";
            } else {
                $error = "Gagal menyimpan ke tabel pelamar.";
            }
        } else {
            $error = "Terjadi kesalahan saat menyimpan data user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
<div class="container">
    <h2>Registrasi Pengguna</h2>

    <?php 
    if (isset($error)) echo "<p class='msg-error'>$error</p>"; 
    if (isset($success)) echo "<p class='msg-success'>$success</p>"; 
    ?>

    <form method="post">
        <label for="user">Username</label>
        <input type="text" name="user" id="user" required>

        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass" required>

        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="no_hp">No HP</label>
        <input type="text" name="no_hp" id="no_hp" required>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" required>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>
</body>
</html>
