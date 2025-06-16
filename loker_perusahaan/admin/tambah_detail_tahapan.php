<?php

include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Tahapan</title>
    <link rel="stylesheet" href="../assets/css/admin/tambah_detail_tahapan.css">
</head>
<body>

<?php
$periode_result = mysqli_query($koneksi, "SELECT * FROM periode WHERE status = 'aktif'");
$tahapan_result = mysqli_query($koneksi, "SELECT * FROM tahapan");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_periode = $_POST['id_periode'];
    $id_tahapan = $_POST['id_tahapan'];
    $urutan = $_POST['urutan'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    $query = "INSERT INTO detail_tahapan (id_periode, id_tahapan, urutan, tanggal_mulai, tanggal_selesai)
              VALUES ('$id_periode', '$id_tahapan', '$urutan', '$tanggal_mulai', '$tanggal_selesai')";
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>alert('Detail tahapan berhasil ditambahkan.'); window.location='detail_tahapan.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data.');</script>";
    }
}
?>

<div class="container">
    <h2>Tambah Detail Tahapan</h2>
    <form method="post" action="">
        <div>
            <label>Periode:</label>
            <select name="id_periode" required>
                <option value="">-- Pilih Periode Aktif --</option>
                <?php while ($p = mysqli_fetch_assoc($periode_result)) : ?>
                    <option value="<?= $p['id_periode']; ?>"><?= $p['periode']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label>Tahapan:</label>
            <select name="id_tahapan" required>
                <option value="">-- Pilih Tahapan --</option>
                <?php while ($t = mysqli_fetch_assoc($tahapan_result)) : ?>
                    <option value="<?= $t['id_tahapan']; ?>"><?= $t['tahapan']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label>Urutan Tahapan:</label>
            <input type="number" name="urutan" required>
        </div>

        <div>
            <label>Tanggal Mulai:</label>
            <input type="date" name="tanggal_mulai" required>
        </div>

        <div>
            <label>Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" required>
        </div>

        <button type="submit">Simpan</button>
        <a href="detail_tahapan.php" class="cancel-btn">Batal</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
