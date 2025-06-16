<?php

include '../config/koneksi.php';
include('../includes/auth/departemen.php');
include '../includes/header.php';

echo '<link rel="stylesheet" href="../assets/css/departemen/pelamar_lowongan.css">';

if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'departemen') {
    header("Location: ../login.php");
    exit;
}

$id_lowongan = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "
    SELECT pl.nama, pl.email, l.status, l.tanggal
    FROM lamaran l
    JOIN pelamar pl ON l.id_pelamar = pl.id_pelamar
    WHERE l.id_lowongan = $id_lowongan
";

$result = mysqli_query($koneksi, $query);
?>

<div class="container">
    <h2>Daftar Pelamar</h2>
    <a href="../pages/dashboard_departemen.php">← Kembali ke Dashboard</a><br><br>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Status Lamaran</th>
            <th>Tanggal Lamaran</th>
        </tr>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td data-label="Nama"><?= htmlspecialchars($row['nama']) ?></td>
                    <td data-label="Email"><?= htmlspecialchars($row['email']) ?></td>
                    <td data-label="Status"><?= htmlspecialchars($row['status']) ?></td>
                    <td data-label="Tanggal"><?= htmlspecialchars($row['tanggal']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Belum ada pelamar untuk lowongan ini.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
