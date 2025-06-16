<?php

include '../config/koneksi.php';
include('../includes/auth/user.php');

echo '<link rel="stylesheet" href="../assets/css/user/lihat_tahapan.css">';

// Cek login user
if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'user') {
    header("Location: ../login.php");
    exit;
}
?>

<div class="container">
    <h2>Jadwal Tahapan Rekrutmen</h2>

    <?php
    $query = "SELECT dt.urutan, t.tahapan AS tahapan, dt.tanggal_mulai, dt.tanggal_selesai
              FROM detail_tahapan dt
              JOIN tahapan t ON dt.id_tahapan = t.id_tahapan
              JOIN periode p ON dt.id_periode = p.id_periode
              WHERE p.status = 'aktif'
              ORDER BY dt.urutan ASC";

    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Urutan</th>
                <th>Nama Tahapan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['urutan'] ?></td>
                    <td><?= htmlspecialchars($row['tahapan']) ?></td>
                    <td><?= $row['tanggal_mulai'] ?></td>
                    <td><?= $row['tanggal_selesai'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Belum ada tahapan yang tersedia untuk periode aktif.</p>
    <?php endif; ?>

    <a href="../pages/dashboard_user.php">Kembali ke Dashboard</a>

</div>

<?php include '../includes/footer.php'; ?>
