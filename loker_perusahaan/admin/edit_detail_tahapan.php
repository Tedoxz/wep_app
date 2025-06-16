<?php

include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

echo '<link rel="stylesheet" href="../assets/css/admin/edit_detail_tahapan.css">';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID detail tidak ditemukan.'); window.location='detail_tahapan.php';</script>";
    exit;
}

$id_detail = $_GET['id'];

// Ambil data detail_tahapan yang akan diedit
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM detail_tahapan WHERE id_detail = '$id_detail'"));

// Ambil data periode & tahapan untuk dropdown
$periode_result = mysqli_query($koneksi, "SELECT * FROM periode WHERE status = 'aktif'");
$tahapan_result = mysqli_query($koneksi, "SELECT * FROM tahapan");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_periode = $_POST['id_periode'];
    $id_tahapan = $_POST['id_tahapan'];
    $urutan = $_POST['urutan'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    $update = mysqli_query($koneksi, "UPDATE detail_tahapan SET
        id_periode = '$id_periode',
        id_tahapan = '$id_tahapan',
        urutan = '$urutan',
        tanggal_mulai = '$tanggal_mulai',
        tanggal_selesai = '$tanggal_selesai'
        WHERE id_detail = '$id_detail'
    ");

    if ($update) {
        echo "<script>alert('Detail tahapan berhasil diperbarui.'); window.location='detail_tahapan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>

<div class="container">
    <h2>Edit Detail Tahapan</h2>
    <form method="post" action="">
        <div style="margin-bottom:10px;">
            <label>Periode:</label><br>
            <select name="id_periode" required style="width: 100%; padding: 8px;">
                <?php while ($p = mysqli_fetch_assoc($periode_result)) : ?>
                    <option value="<?= $p['id_periode']; ?>" <?= $p['id_periode'] == $data['id_periode'] ? 'selected' : ''; ?>>
                        <?= $p['periode']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div style="margin-bottom:10px;">
            <label>Tahapan:</label><br>
            <select name="id_tahapan" required style="width: 100%; padding: 8px;">
                <?php while ($t = mysqli_fetch_assoc($tahapan_result)) : ?>
                    <option value="<?= $t['id_tahapan']; ?>" <?= $t['id_tahapan'] == $data['id_tahapan'] ? 'selected' : ''; ?>>
                        <?= $t['tahapan']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div style="margin-bottom:10px;">
            <label>Urutan Tahapan:</label><br>
            <input type="number" name="urutan" value="<?= $data['urutan']; ?>" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Tanggal Mulai:</label><br>
            <input type="date" name="tanggal_mulai" value="<?= $data['tanggal_mulai']; ?>" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Tanggal Selesai:</label><br>
            <input type="date" name="tanggal_selesai" value="<?= $data['tanggal_selesai']; ?>" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="padding:10px 20px;background-color:#007bff;color:white;border:none;border-radius:4px;">Simpan Perubahan</button>
        <a href="detail_tahapan.php" style="margin-left:10px;color:#555;text-decoration:none;">Batal</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
