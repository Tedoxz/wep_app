<?php
include '../config/koneksi.php';
include('../includes/auth/departemen.php');
include '../includes/header.php';

echo '<link rel="stylesheet" href="../assets/css/departemen/tambah_lowongan.css">';

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
$pesan = '';

// Ambil data periode aktif
$queryPeriode = "SELECT * FROM periode WHERE status = 'aktif'";
$resultPeriode = mysqli_query($koneksi, $queryPeriode);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $posisi = mysqli_real_escape_string($koneksi, $_POST['posisi']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $kualifikasi = mysqli_real_escape_string($koneksi, $_POST['kualifikasi']);
    $tanggal_buka = $_POST['tanggal_buka'];
    $tanggal_tutup = $_POST['tanggal_tutup'];
    $kuota = (int)$_POST['kuota'];
    $id_periode = (int)$_POST['id_periode'];

    $query = "INSERT INTO lowongan (id_department, posisi, deskripsi, kualifikasi, tanggal_buka, tanggal_tutup, kuota, id_periode) 
              VALUES ('$id_department', '$posisi', '$deskripsi', '$kualifikasi', '$tanggal_buka', '$tanggal_tutup', '$kuota', '$id_periode')";

    if (mysqli_query($koneksi, $query)) {
        $pesan = "Lowongan berhasil ditambahkan!";
    } else {
        $pesan = "Gagal menambahkan lowongan: " . mysqli_error($koneksi);
    }
}
?>

<div class="container">
    <h2>Tambah Lowongan Baru</h2>

    <?php if ($pesan) : ?>
        <p style="color: green;"><?= $pesan ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Posisi:</label><br>
        <input type="text" name="posisi" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" required></textarea><br><br>

        <label>Kualifikasi:</label><br>
        <textarea name="kualifikasi" rows="5" required></textarea><br><br>

        <label>Tanggal Buka:</label><br>
        <input type="date" name="tanggal_buka" required><br><br>

        <label>Tanggal Tutup:</label><br>
        <input type="date" name="tanggal_tutup" required><br><br>

        <label>Kuota:</label><br>
        <input type="number" name="kuota" min="1" required><br><br>

        <label>Pilih Periode:</label><br>
        <select name="id_periode" required>
            <option value="">-- Pilih Periode --</option>
            <?php while ($periode = mysqli_fetch_assoc($resultPeriode)) : ?>
                <option value="<?= $periode['id_periode'] ?>"><?= htmlspecialchars($periode['periode']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
            <button type="submit">Simpan</button>
            <a href="../pages/dashboard_departemen.php" class="btn-back">Kembali</a>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
