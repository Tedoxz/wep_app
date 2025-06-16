<?php
include '../config/koneksi.php';
session_start();

// Cek login
if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_lowongan = $_POST['id_lowongan'];

// Ambil id_pelamar dari tabel pelamar (berdasarkan user login)
$getPelamar = mysqli_query($koneksi, "SELECT id_pelamar FROM pelamar_profil WHERE id_user = $id_user");
$dataPelamar = mysqli_fetch_assoc($getPelamar);
$id_pelamar = $dataPelamar['id_pelamar'];

// Ambil id_periode aktif berdasarkan id_lowongan
$getPeriode = mysqli_query($koneksi, "
    SELECT id_periode FROM periode 
    WHERE id_lowongan = $id_lowongan AND status = 'aktif'
    LIMIT 1
");
$dataPeriode = mysqli_fetch_assoc($getPeriode);
$id_periode = $dataPeriode['id_periode'];

// Ambil tahapan pertama (urutan = 1)
$getDetailTahapan = mysqli_query($koneksi, "
    SELECT id_detail FROM detail_tahapan 
    WHERE id_periode = $id_periode AND urutan = 1
    LIMIT 1
");
$dataDetail = mysqli_fetch_assoc($getDetailTahapan);
$id_detail = $dataDetail['id_detail'];

// Insert ke tabel pelamar
$insert = mysqli_query($koneksi, "
    INSERT INTO pelamar (id_pelamar, id_detail, tanggal, status)
    VALUES ($id_pelamar, $id_detail, NOW(), 'daftar')
");

if ($insert) {
    header("Location: dashboard_user.php?msg=berhasil_daftar");
} else {
    echo "Gagal daftar: " . mysqli_error($koneksi);
}
?>
