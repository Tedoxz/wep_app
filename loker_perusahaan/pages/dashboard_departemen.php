<?php
include '../config/koneksi.php';
include('../includes/auth/departemen.php');
include '../includes/header.php';

if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'departemen') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$queryDept = "SELECT * FROM department WHERE id_user = $id_user";
$resultDept = mysqli_query($koneksi, $queryDept);
$department = mysqli_fetch_assoc($resultDept);

if (!$department) {
    echo "<h3>Data departemen tidak ditemukan!</h3>";
    exit;
}

$id_department = $department['id'];
$querylowongan = "SELECT * FROM lowongan WHERE id_department = $id_department ORDER BY tanggal_buka DESC";
$resultlowongan = mysqli_query($koneksi, $querylowongan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Departemen</title>
    <link rel="stylesheet" href="../assets/css/departemen/dashboard.css">
</head>
<body>
<div class="container">
    <h2>Selamat Datang, <?= htmlspecialchars($department['nama']) ?></h2>
    
    <a href="../departemen/tambah_lowongan.php" class="btn-add">➕ Tambah Lowongan</a>

    <h3>Daftar Lowongan yang Dibuat:</h3>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Posisi</th>
                    <th>Deskripsi</th>
                    <th>Kualifikasi</th>
                    <th>Periode</th>
                    <th>Kuota</th>
                    <th>Tanggal Buka</th>
                    <th>Tanggal Tutup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultlowongan)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['posisi']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['kualifikasi'])) ?></td>
                        <td>
                            <?php
                            $id_periode = $row['id_periode'];
                            $resultPeriode = mysqli_query($koneksi, "SELECT periode FROM periode WHERE id_periode = $id_periode");
                            $periode = mysqli_fetch_assoc($resultPeriode);
                            echo $periode ? htmlspecialchars($periode['periode']) : '-';
                            ?>
                        </td>
                        <td><?= (int)$row['kuota'] ?></td>
                        <td><?= htmlspecialchars($row['tanggal_buka']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_tutup']) ?></td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                            <a href="../departemen/pelamar_lowongan.php?id=<?= $row['id_lowongan'] ?>" class="btn-action">Pelamar</a>
                            <a href="../departemen/edit_lowongan.php?id=<?= $row['id_lowongan'] ?>" class="btn-action">Edit</a>
                            <a href="../departemen/hapus_lowongan.php?id=<?= $row['id_lowongan'] ?>" class="btn-delete"
                               onclick="return confirm('Yakin ingin menghapus lowongan ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
