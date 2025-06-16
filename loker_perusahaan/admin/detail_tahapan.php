<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Detail Tahapan</title>
    <link rel="stylesheet" href="../assets/css/admin/detail_tahapan.css">
</head>
<body>

<?php
$query = "
    SELECT dt.*, p.periode, t.tahapan 
    FROM detail_tahapan dt 
    JOIN periode p ON dt.id_periode = p.id_periode 
    JOIN tahapan t ON dt.id_tahapan = t.id_tahapan 
    ORDER BY dt.id_periode, dt.urutan
";
$result = mysqli_query($koneksi, $query);
?>

<div class="container">
    <h2>Data Detail Tahapan</h2>
    <a href="../pages/dashboard_admin.php" class="back-link">← Kembali ke Dashboard</a><br><br>
    <a href="tambah_detail_tahapan.php" class="add-button">+ Tambah Detail Tahapan</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Tahapan</th>
                <th>Urutan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1;
        while($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['periode']); ?></td>
                <td><?= htmlspecialchars($row['tahapan']); ?></td>
                <td><?= $row['urutan']; ?></td>
                <td><?= $row['tanggal_mulai']; ?></td>
                <td><?= $row['tanggal_selesai']; ?></td>
                <td>
                    <a href="edit_detail_tahapan.php?id=<?= $row['id_detail']; ?>">Edit</a> | 
                    <a href="hapus_detail_tahapan.php?id=<?= $row['id_detail']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
