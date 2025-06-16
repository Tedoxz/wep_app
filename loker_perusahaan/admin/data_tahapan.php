<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tahapan Seleksi</title>
    <link rel="stylesheet" href="../assets/css/admin/data_tahapan.css">
</head>
<body>

<?php
// Proses tambah tahapan
if (isset($_POST['tambah'])) {
    $tahapan = mysqli_real_escape_string($koneksi, $_POST['tahapan']);
    mysqli_query($koneksi, "INSERT INTO tahapan (tahapan) VALUES ('$tahapan')");
    header("Location: data_tahapan.php");
    exit;
}

// Proses hapus tahapan
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM tahapan WHERE id_tahapan = $id");
    header("Location: data_tahapan.php");
    exit;
}

// Ambil semua tahapan
$result = mysqli_query($koneksi, "SELECT * FROM tahapan ORDER BY id_tahapan DESC");
?>

<div class="container">
    <h2>Data Tahapan Seleksi</h2>
    <a href="../pages/dashboard_admin.php">← Kembali ke Dashboard</a><br><br>

    <!-- Form Tambah Tahapan -->
    <form method="post">
        <input type="text" name="tahapan" placeholder="Nama Tahapan" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Tabel Tahapan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tahapan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['tahapan']) ?></td>
                <td>
                    <a href="edit_tahapan.php?id=<?= $row['id_tahapan'] ?>">Edit</a> |
                    <a href="data_tahapan.php?hapus=<?= $row['id_tahapan'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
