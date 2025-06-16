<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Periode</title>
    <link rel="stylesheet" href="../assets/css/admin/data_periode.css">
</head>
<body>

<?php
// Proses tambah
if (isset($_POST['tambah'])) {
    $periode = mysqli_real_escape_string($koneksi, $_POST['periode']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    mysqli_query($koneksi, "INSERT INTO periode (periode, status) VALUES ('$periode', '$status')");
    header("Location: data_periode.php");
    exit;
}

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM periode WHERE id_periode = $id");
    header("Location: data_periode.php");
    exit;
}

// Ambil semua data periode
$result = mysqli_query($koneksi, "SELECT * FROM periode ORDER BY id_periode DESC");
?>

<div class="container">
    <h2>Data Periode</h2>
    <a href="../pages/dashboard_admin.php">← Kembali ke Dashboard</a><br><br>

    <!-- Form Tambah -->
    <form method="post">
        <input type="text" name="periode" placeholder="Nama Periode" required>
        <select name="status" required>
            <option value="">-- Status --</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['periode']) ?></td>
                <td><?= $row['status'] == 'aktif' ? 'Aktif' : 'Nonaktif' ?></td>
                <td>
                    <a href="edit_periode.php?id=<?= $row['id_periode'] ?>">Edit</a> |
                    <a href="data_periode.php?hapus=<?= $row['id_periode'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
