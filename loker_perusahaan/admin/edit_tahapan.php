<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

// Tambahkan link ke CSS
echo '<link rel="stylesheet" href="../assets/css/admin/edit_tahapan.css">';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tahapan tidak ditemukan'); window.location='data_tahapan.php';</script>";
    exit;
}

$id_tahapan = (int)$_GET['id'];
$query = "SELECT * FROM tahapan WHERE id_tahapan = $id_tahapan";
$result = mysqli_query($koneksi, $query);
$tahapan = mysqli_fetch_assoc($result);

if (!$tahapan) {
    echo "<script>alert('Data tidak ditemukan'); window.location='data_tahapan.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_tahapan = mysqli_real_escape_string($koneksi, $_POST['nama_tahapan']);

    if (!empty($nama_tahapan)) {
        $update = "UPDATE tahapan SET tahapan = '$nama_tahapan' WHERE id_tahapan = $id_tahapan";
        if (mysqli_query($koneksi, $update)) {
            echo "<script>alert('Data berhasil diperbarui'); window.location='data_tahapan.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal mengupdate data');</script>";
        }
    } else {
        echo "<script>alert('Nama tahapan tidak boleh kosong');</script>";
    }
}
?>

<div class="form-container">
    <h2>Edit Tahapan Seleksi</h2>
    <form method="POST" class="form-box">
        <label>Nama Tahapan:</label>
        <input type="text" name="nama_tahapan" value="<?= htmlspecialchars($tahapan['tahapan']); ?>" required>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="data_tahapan.php" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
