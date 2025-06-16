<?php

include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

// Link ke CSS eksternal
echo '<link rel="stylesheet" href="../assets/css/admin/data_lowongan.css">';

// Proses hapus data jika diminta
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM lowongan WHERE id_lowongan = $id");
    echo "<script>alert('Lowongan berhasil dihapus'); window.location='data_lowongan.php';</script>";
    exit;
}

// Ambil semua data lowongan
$result = mysqli_query($koneksi, "
    SELECT l.*, d.nama 
    FROM lowongan l
    LEFT JOIN department d ON l.id_department = d.id
    ORDER BY l.id_lowongan DESC
");
?>

<div class="container">
    <h2>Data Lowongan</h2>
    <a class="back-link" href="../pages/dashboard_admin.php">← Kembali ke Dashboard</a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lowongan</th>
                    <th>Departemen</th>
                    <th>Deskripsi</th>
                    <th>Kuota</th>
                    <th>Tanggal Buka</th>
                    <th>Tanggal Tutup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['posisi']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></td>
                        <td><?= $row['kuota'] ?></td>
                        <td><?= $row['tanggal_buka'] ?></td>
                        <td><?= $row['tanggal_tutup'] ?></td>
                        <td>
                            <a href="lihat_pelamar.php?id_lowongan=<?= $row['id_lowongan'] ?>" class="btn-lihat">Lihat Pelamar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
