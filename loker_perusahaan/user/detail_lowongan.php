<?php
include '../config/koneksi.php';
include('../includes/auth/user.php');
include '../includes/header.php';

echo '<link rel="stylesheet" href="../assets/css/user/detail_lowongan.css">';

if (!isset($_GET['id'])) {
    echo "ID lowongan tidak ditemukan.";
    exit;
}

$id_lowongan = intval($_GET['id']); // Pastikan hanya integer untuk keamanan

// Ambil data lowongan berdasarkan ID
$query = "
    SELECT l.*, d.nama AS nama_department
    FROM lowongan l
    JOIN department d ON l.id_department = d.id
    WHERE l.id_lowongan = $id_lowongan
";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Lowongan tidak ditemukan.";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<div class="container">
    <h2>Detail Lowongan</h2>
    <table>
        <tr><th>Posisi</th><td><?= htmlspecialchars($data['posisi']); ?></td></tr>
        <tr><th>Departemen</th><td><?= htmlspecialchars($data['nama_department']); ?></td></tr>
        <tr><th>Deskripsi</th><td><?= nl2br(htmlspecialchars($data['deskripsi'])); ?></td></tr>
        <tr><th>Kualifikasi</th><td><?= nl2br(htmlspecialchars($data['kualifikasi'])); ?></td></tr>
        <tr><th>Tanggal Buka</th><td><?= $data['tanggal_buka']; ?></td></tr>
        <tr><th>Tanggal Tutup</th><td><?= $data['tanggal_tutup']; ?></td></tr>
        <tr><th>Kuota</th><td><?= $data['kuota']; ?></td></tr>
    </table>

    <a class="button" href="../pages/dashboard_user.php">Kembali ke Dashboard</a>
</div>

<?php include '../includes/footer.php'; ?>
