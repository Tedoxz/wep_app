<?php

include '../config/koneksi.php';
include('../includes/auth/user.php');
include '../includes/header.php';

echo '<link rel="stylesheet" href="../assets/css/user/dashboard.css">';

// Cek login user
if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil nama perusahaan dari profil (jika user memiliki profil perusahaan)
$profilQuery = "SELECT nama FROM profil WHERE id_user = $id_user";
$profilResult = mysqli_query($koneksi, $profilQuery);
$profil = mysqli_fetch_assoc($profilResult);

// Ambil semua lowongan dari semua perusahaan
$query = "SELECT 
            lowongan.id_lowongan, 
            lowongan.posisi, 
            lowongan.deskripsi, 
            lowongan.tanggal_buka, 
            lowongan.tanggal_tutup, 
            lowongan.kuota, 
            department.nama AS nama_departemen, 
            profil.nama AS nama
          FROM lowongan 
          JOIN department ON lowongan.id_department = department.id
          JOIN user ON department.id_user = user.id_user
          JOIN profil ON profil.id_user = user.id_user
          ORDER BY lowongan.tanggal_buka DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="container">
    <h2>Selamat Datang di Website Loker PT.XYZ !</h2>
    <p>Silakan lihat dan daftar lowongan pekerjaan yang tersedia dari perusahaan kami.</p>

    <a href="../user/lamaran_saya.php">
        <button type="button">Lamaran Saya</button>
    </a>

    <h3>Lowongan Pekerjaan Tersedia:</h3>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="lowongan-card">
                <h4><?= htmlspecialchars($row['posisi']) ?></h4>
                <p><strong>Departemen:</strong> <?= htmlspecialchars($row['nama_departemen']) ?></p>
                <p><?= nl2br(htmlspecialchars(substr($row['deskripsi'], 0, 100))) ?>...</p>
                <p><strong>Tanggal:</strong> <?= $row['tanggal_buka'] ?> s/d <?= $row['tanggal_tutup'] ?> | <strong>Kuota:</strong> <?= $row['kuota'] ?></p>

                <a href="../user/detail_lowongan.php?id=<?= $row['id_lowongan'] ?>" class="button-link"><button type="button">Lihat Detail</button></a>
                <a href="../user/daftar_lowongan.php?id=<?= $row['id_lowongan'] ?>" class="button-link"><button type="button">Daftar Lowongan</button></a>
                <a href="../user/lihat_tahapan.php?id_lowongan=<?= $row['id_lowongan'] ?>" class="button-link"><button type="button">Lihat Tahapan</button></a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Belum ada lowongan tersedia.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
