<?php
include '../config/koneksi.php';
session_start();

// Cek autentikasi
if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'departemen') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data departemen
$queryDept = "SELECT * FROM department WHERE id_user = $id_user";
$resultDept = mysqli_query($koneksi, $queryDept);
$department = mysqli_fetch_assoc($resultDept);

if (!$department) {
    echo "Data departemen tidak ditemukan!";
    exit;
}

$id_department = $department['id'];

// Ambil id lowongan dari URL
if (!isset($_GET['id'])) {
    echo "ID lowongan tidak ditemukan!";
    exit;
}

$id_lowongan = (int)$_GET['id'];

// Ambil data lowongan
$query = "SELECT * FROM lowongan WHERE id_lowongan = $id_lowongan AND id_department = $id_department";
$result = mysqli_query($koneksi, $query);
$lowongan = mysqli_fetch_assoc($result);

if (!$lowongan) {
    echo "Lowongan tidak ditemukan!";
    exit;
}

// Ambil daftar periode aktif
$periodeQuery = mysqli_query($koneksi, "SELECT * FROM periode ORDER BY id_periode DESC");

// Proses update saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $posisi = $_POST['posisi'];
    $deskripsi = $_POST['deskripsi'];
    $kualifikasi = $_POST['kualifikasi'];
    $kuota = $_POST['kuota'];
    $tanggal_buka = $_POST['tanggal_buka'];
    $tanggal_tutup = $_POST['tanggal_tutup'];
    $id_periode = $_POST['id_periode'];

    $updateQuery = "UPDATE lowongan SET 
        posisi = '$posisi',
        deskripsi = '$deskripsi',
        kualifikasi = '$kualifikasi',
        kuota = '$kuota',
        tanggal_buka = '$tanggal_buka',
        tanggal_tutup = '$tanggal_tutup',
        id_periode = '$id_periode'
        WHERE id_lowongan = $id_lowongan";

    if (mysqli_query($koneksi, $updateQuery)) {
        header("Location: dashboard_departemen.php");
        exit;
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Lowongan</title>
    <link rel="stylesheet" href="../assets/css/departemen/edit_lowongan.css">
</head>
<body>
    <div class="container">
    <h2>Edit Lowongan</h2>
    <form method="post">
        <label>Posisi:</label><br>
        <input type="text" name="posisi" value="<?= htmlspecialchars($lowongan['posisi']) ?>" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="4" required><?= htmlspecialchars($lowongan['deskripsi']) ?></textarea><br><br>

        <label>Kualifikasi:</label><br>
        <textarea name="kualifikasi" rows="4" required><?= htmlspecialchars($lowongan['kualifikasi']) ?></textarea><br><br>

        <label>Kuota:</label><br>
        <input type="number" name="kuota" value="<?= (int)$lowongan['kuota'] ?>" required><br><br>

        <label>Tanggal Buka:</label><br>
        <input type="date" name="tanggal_buka" value="<?= htmlspecialchars($lowongan['tanggal_buka']) ?>" required><br><br>

        <label>Tanggal Tutup:</label><br>
        <input type="date" name="tanggal_tutup" value="<?= htmlspecialchars($lowongan['tanggal_tutup']) ?>" required><br><br>

        <label>Periode:</label><br>
        <select name="id_periode" required>
            <?php while ($p = mysqli_fetch_assoc($periodeQuery)) : ?>
                <option value="<?= $p['id_periode'] ?>" <?= ($p['id_periode'] == $lowongan['id_periode']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['periode']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="../pages/dashboard_departemen.php">Batal</a>
    </form>
    </div>
</body>
</html>
