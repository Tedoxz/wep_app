<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

// Tambahkan link ke file CSS eksternal
echo '<link rel="stylesheet" href="../assets/css/admin/edit_periode.css">';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location='data_periode.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM periode WHERE id_periode = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan'); window.location='data_periode.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $periode = mysqli_real_escape_string($koneksi, $_POST['periode']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    mysqli_query($koneksi, "UPDATE periode SET periode='$periode', status='$status' WHERE id_periode=$id");
    echo "<script>alert('Data berhasil diperbarui'); window.location='data_periode.php';</script>";
    exit;
}
?>

<div class="form-container">
    <h2>Edit Periode</h2>

    <form method="post" class="form-box">
        <label>Nama Periode:</label>
        <input type="text" name="periode" value="<?= htmlspecialchars($data['periode']) ?>" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="">-- Pilih Status --</option>
            <option value="aktif" <?= $data['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="nonaktif" <?= $data['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
        </select>

        <div class="form-actions">
            <button type="submit" name="update" class="btn-primary">Update</button>
            <a href="data_periode.php" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
