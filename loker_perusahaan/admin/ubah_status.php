<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pelamar = intval($_POST['id_pelamar']);
    $id_lowongan = intval($_POST['id_lowongan']);
    $status = $_POST['status'];

    $query = "UPDATE lamaran SET status = '$status' 
              WHERE id_pelamar = $id_pelamar AND id_lowongan = $id_lowongan";
    mysqli_query($koneksi, $query);

    header("Location: lihat_pelamar.php?id_lowongan=$id_lowongan");
    exit;
}
?>
