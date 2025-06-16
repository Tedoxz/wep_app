<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');

if (!isset($_GET['id'])) {
    echo "<script>alert('ID detail tidak ditemukan.'); window.location='detail_tahapan.php';</script>";
    exit;
}

$id_detail = $_GET['id'];

// Eksekusi penghapusan
$hapus = mysqli_query($koneksi, "DELETE FROM detail_tahapan WHERE id_detail = '$id_detail'");

if ($hapus) {
    echo "<script>alert('Data detail tahapan berhasil dihapus.'); window.location='detail_tahapan.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data.'); window.location='detail_tahapan.php';</script>";
}
