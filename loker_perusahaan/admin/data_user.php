<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

// Link ke CSS eksternal
echo '<link rel="stylesheet" href="../assets/css/admin/data_user.css">';

// Proses hapus user
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id");
    header("Location: data_user.php");
    exit;
}

// Ambil semua data user
$result = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user DESC");
?>

<div class="container">
    <h2>Data User</h2>
    <a class="back-link" href="../pages/dashboard_admin.php">← Kembali ke Dashboard</a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Akses</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['user']) ?></td>
                        <td><?= htmlspecialchars($row['akses']) ?></td>
                        <td>
                            <a class="btn-delete" href="data_user.php?hapus=<?= $row['id_user'] ?>" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
