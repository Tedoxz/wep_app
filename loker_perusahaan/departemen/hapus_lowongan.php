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
    echo "Akses ditolak! Anda bukan bagian dari departemen.";
    exit;
}

$id_department = $department['id'];

// Ambil ID lowongan dari URL
if (!isset($_GET['id'])) {
    echo "ID lowongan tidak ditemukan.";
    exit;
}

$id_lowongan = (int)$_GET['id'];

// Cek apakah lowongan tersebut milik departemen ini
$checkQuery = "SELECT * FROM lowongan WHERE id_lowongan = $id_lowongan AND id_department = $id_department";
$result = mysqli_query($koneksi, $checkQuery);
if (mysqli_num_rows($result) == 0) {
    echo "Lowongan tidak ditemukan atau bukan milik Anda.";
    exit;
}

// Hapus lowongan
$deleteQuery = "DELETE FROM lowongan WHERE id_lowongan = $id_lowongan";
if (mysqli_query($koneksi, $deleteQuery)) {
    header("Location: ../pages/dashboard_departemen.php?hapus=berhasil");
    exit;
} else {
    echo "Gagal menghapus lowongan.";
}
?>
