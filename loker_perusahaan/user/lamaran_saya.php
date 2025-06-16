<?php
include '../config/koneksi.php';
include('../includes/auth/user.php');
include '../includes/header.php';

echo '<link rel="stylesheet" href="../assets/css/user/lamaran_saya.css">';

if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil semua lamaran user ini
$query = "
SELECT 
    l.id_lamar,
    low.id_lowongan,
    low.posisi,
    l.tanggal,
    l.status,
    d.nama AS nama_departemen
FROM lamaran l
JOIN pelamar p ON l.id_pelamar = p.id_pelamar
JOIN lowongan low ON l.id_lowongan = low.id_lowongan
JOIN department d ON low.id_department = d.id
WHERE p.id_user = $id_user
ORDER BY l.tanggal DESC
";

$result = mysqli_query($koneksi, $query);
?>

<div class="container">
    <h2>Lamaran Saya</h2>

    <a href="../pages/dashboard_user.php">Kembali ke Dashboard</a>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Posisi</th>
                <th>Departemen</th>
                <th>Tanggal Lamar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['posisi']) ?></td>
                    <td data-label="Departemen"><?= htmlspecialchars($row['nama_departemen']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td>
                        <a href="lihat_tahapan.php?id_lowongan=<?= $row['id_lowongan'] ?>">Lihat Tahapan</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Belum ada lamaran yang dikirim.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
