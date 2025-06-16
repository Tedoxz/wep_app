<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

// Hitung total data
$jumlah_pelamar = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pelamar"))['total'];
$jumlah_lowongan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM lowongan"))['total'];
$jumlah_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user"))['total'];
$jumlah_periode = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM periode"))['total'];
$jumlah_tahapan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tahapan"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/admin/dashboard_admin.css">
</head>
<body>
<div class="container">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <strong><?= isset($_SESSION['user']) ? $_SESSION['user'] : 'Admin'; ?></strong>!</p>

    <div class="dashboard-cards" style="display: flex; flex-wrap: wrap; gap: 20px;">

        <!-- Card: Pelamar -->
        <div
            style="border: 1px solid #ccc; padding: 20px; flex: 1; min-width: 250px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 6px;">
            <h4>Total Pelamar</h4>
            <p><?= $jumlah_pelamar; ?> orang</p>
            <a href="../admin/data_pelamar.php"
                style="display:block;padding:10px;background-color:#28a745;color:white;text-align:center;text-decoration:none;border-radius:4px;">Lihat
                Data Pelamar</a>
        </div>

        <!-- Card: Periode -->
        <div
            style="border: 1px solid #ccc; padding: 20px; flex: 1; min-width: 250px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 6px;">
            <h4>Total Periode</h4>
            <p><?= $jumlah_periode; ?> periode</p>
            <a href="../admin/data_periode.php"
                style="display:block;padding:10px;background-color:#ffc107;color:black;text-align:center;text-decoration:none;border-radius:4px;">Lihat
                Data Periode</a>
        </div>

        <!-- Card: Tahapan -->
        <div
            style="border: 1px solid #ccc; padding: 20px; flex: 1; min-width: 250px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 6px;">
            <h4>Total Tahapan</h4>
            <p><?= $jumlah_tahapan; ?> tahapan</p>
            <a href="../admin/data_tahapan.php"
                style="display:block;padding:10px;background-color:#17a2b8;color:white;text-align:center;text-decoration:none;border-radius:4px;margin-bottom:8px;">Lihat
                Data Tahapan</a>
            <a href="../admin/detail_tahapan.php"
                style="display:block;padding:10px;background-color:#dc3545;color:white;text-align:center;text-decoration:none;border-radius:4px;">Lihat
                Detail Tahapan</a>
        </div>

        <!-- Card: User -->
        <div
            style="border: 1px solid #ccc; padding: 20px; flex: 1; min-width: 250px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 6px;">
            <h4>Total User</h4>
            <p><?= $jumlah_user; ?> akun</p>
            <a href="../admin/data_user.php"
                style="display:block;padding:10px;background-color:#007bff;color:white;text-align:center;text-decoration:none;border-radius:4px;">Lihat
                Data User</a>
        </div>

        <!-- Card: Lowongan -->
        <div
            style="border: 1px solid #ccc; padding: 20px; flex: 1; min-width: 250px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 6px;">
            <h4>Total Lowongan</h4>
            <p><?= $jumlah_lowongan; ?> posisi</p>
            <a href="../admin/data_lowongan.php"
                style="display:block;padding:10px;background-color:#6c757d;color:white;text-align:center;text-decoration:none;border-radius:4px;">Lihat
                Data Lowongan</a>    
        </div>
        <!-- Card: Departemen -->
        <div
            style="border: 1px solid #ccc; padding: 20px; flex: 1; min-width: 250px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 6px;">
            <h4>Total Departemen</h4>
            <?php
                $query_departemen = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM department");
                $data_departemen = mysqli_fetch_assoc($query_departemen);
                $jumlah_departemen = $data_departemen['total'];
            ?>
            <p><?= $jumlah_departemen; ?> departemen</p>
            <a href="../admin/data_departemen.php"
                style="display:block;padding:10px;background-color:#8e44ad;color:white;text-align:center;text-decoration:none;border-radius:4px;">Lihat
                Data Departemen</a>
        </div>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>