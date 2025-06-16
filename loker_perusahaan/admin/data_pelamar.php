<?php

include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';


// Cek apakah admin
if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil data pelamar beserta data user-nya
$query = "
    SELECT p.id_pelamar, u.user, p.nama, p.email, p.no_hp, p.alamat, p.cv_file
    FROM pelamar p
    JOIN user u ON p.id_user = u.id_user
    ORDER BY p.id_pelamar DESC
";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelamar</title>
    <link rel="stylesheet" href="../assets/css/admin/data_pelamar.css">
</head>
<body>
    <h2>Data Pelamar</h2>
    <a href="../pages/dashboard_admin.php">← Kembali ke Dashboard</a><br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>CV</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['user']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['no_hp']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['alamat'])) ?></td>
            <td>
                <?php if ($row['cv_file']) : ?>
                    <a href="../uploads/<?= htmlspecialchars($row['cv_file']) ?>" target="_blank">Lihat CV</a>
                <?php else : ?>
                    Tidak Ada CV
                <?php endif; ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php include '../includes/footer.php'; ?>