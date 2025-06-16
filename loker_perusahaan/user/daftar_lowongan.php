<?php

include '../config/koneksi.php';
include('../includes/auth/user.php');
include '../includes/header.php';

if (!isset($_SESSION['id_user']) || $_SESSION['akses'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_lowongan = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data pelamar dari tabel pelamar
$dataPelamar = mysqli_query($koneksi, "SELECT * FROM pelamar WHERE id_user = '$id_user' ORDER BY id_pelamar DESC LIMIT 1");
$pelamar = mysqli_fetch_assoc($dataPelamar);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Upload file CV
    $cv_file = '';
    if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
        $targetDir = "../uploads/cv/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = basename($_FILES["cv_file"]["name"]);
        $fileName = preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
        $targetFilePath = $targetDir . time() . '_' . $fileName;

        if (move_uploaded_file($_FILES["cv_file"]["tmp_name"], $targetFilePath)) {
            $cv_file = $targetFilePath;
        } else {
            echo "<script>alert('Gagal upload CV.');</script>";
        }
    }

    // Masukkan data ke pelamar (kalau perlu update) atau langsung insert ke lamaran
    if ($pelamar) {
        $id_pelamar = $pelamar['id_pelamar'];

        // Update CV baru
        $update = mysqli_query($koneksi, "UPDATE pelamar SET cv_file = '$cv_file', id_lowongan = '$id_lowongan' WHERE id_pelamar = '$id_pelamar'");
    } else {
        // Insert pelamar kalau belum ada
        $nama = $_SESSION['nama'] ?? '';
        $email = $_SESSION['email'] ?? '';
        $no_hp = $_SESSION['no_hp'] ?? '';
        $alamat = $_SESSION['alamat'] ?? '';

        mysqli_query($koneksi, "INSERT INTO pelamar (id_user, nama, email, no_hp, alamat, cv_file, id_lowongan)
                                VALUES ('$id_user', '$nama', '$email', '$no_hp', '$alamat', '$cv_file', '$id_lowongan')");
        $id_pelamar = mysqli_insert_id($koneksi);
    }

    // Insert ke lamaran
    $queryLamaran = "INSERT INTO lamaran (id_pelamar, id_lowongan, tanggal, status) 
                     VALUES ('$id_pelamar', '$id_lowongan', NOW(), 'daftar')";

    if (mysqli_query($koneksi, $queryLamaran)) {
        echo "<script>alert('Lamaran berhasil dikirim.'); window.location.href='../pages/dashboard_user.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan ke tabel lamaran: " . mysqli_error($koneksi) . "');</script>";
    }

    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Upload CV</title>
    <link rel="stylesheet" href="../assets/css/user/daftar_lowongan.css">
</head>
<body>
    <div class="container">
    <h2>Upload CV untuk Lamaran</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Upload CV (PDF/DOC):</label><br>
        <input type="file" name="cv_file" accept=".pdf,.doc,.docx" required><br><br>

        <button type="submit">Kirim Lamaran</button>
        <a href="../pages/dashboard_user.php">Batal</a>
    </form>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>
