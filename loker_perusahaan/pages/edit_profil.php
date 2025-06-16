<?php

include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

// Ambil data profil pertama (karena hanya satu perusahaan)
$query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);

// Cek jika form disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $deskripsi = $_POST['deskripsi'];

    // Logo
    $logo = $profil['logo']; // logo lama
    if ($_FILES['logo']['name']) {
        $nama_file = $_FILES['logo']['name'];
        $tmp = $_FILES['logo']['tmp_name'];
        $lokasi = "uploads/" . $nama_file;

        // Simpan file baru
        move_uploaded_file($tmp, $lokasi);
        $logo = $nama_file;
    }

    // Update ke database
    $sql = "UPDATE profil SET 
            nama='$nama', 
            alamat='$alamat', 
            email='$email', 
            telepon='$telepon', 
            deskripsi='$deskripsi', 
            logo='$logo' 
            WHERE id=" . $profil['id'];

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Profil berhasil diperbarui'); window.location='profil.php';</script>";
    } else {
        echo "Gagal mengupdate profil: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil Perusahaan</title>
</head>
<body>
    <h2>Edit Profil Perusahaan</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Perusahaan:</label><br>
        <input type="text" name="nama" value="<?= $profil['nama']; ?>"><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat"><?= $profil['alamat']; ?></textarea><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $profil['email']; ?>"><br><br>

        <label>Telepon:</label><br>
        <input type="text" name="telepon" value="<?= $profil['telepon']; ?>"><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"><?= $profil['deskripsi']; ?></textarea><br><br>

        <label>Logo:</label><br>
        <?php if ($profil['logo']): ?>
            <img src="uploads/<?= $profil['logo']; ?>" width="100"><br>
        <?php endif; ?>
        <input type="file" name="logo"><br><br>

        <input type="submit" name="submit" value="Simpan">
    </form>
</body>
</html>
<?php include '../includes/footer.php'; ?>