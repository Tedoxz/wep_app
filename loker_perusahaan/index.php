<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang - Portal Lowongan Kerja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">

    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .info-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 40px 20px;
            flex-wrap: wrap;
        }
        .info-card {
            border: 2px solid black;
            padding: 20px;
            width: 300px;
            cursor: pointer;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: all 0.3s;
        }
        .info-card:hover {
            background-color: #eef;
            transform: scale(1.02);
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        header {
            background: linear-gradient(to right, #5f0fff, #4da6ff);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 20px;
            font-weight: bold;
        }
        header nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }
        .hero {
            text-align: center;
            margin-top: 60px;
        }
        footer {
            text-align: center;
            margin: 40px 0 20px;
            color: #777;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">Portal Loker Perusahaan PT.XYZ</div>
    <nav>
        <a href="auth/login.php">Login</a>
        <a href="pages/profil.php">Profil Perusahaan</a>
    </nav>
</header>

<section class="hero">
    <h1>Selamat Datang di Portal Lowongan Kerja</h1>
    <p>Temukan pekerjaan impianmu di perusahaan PT.XYZ dan departemen terbaik.</p>
    <a href="auth/login.php"><button class="btn-primary">Masuk ke Portal</button></a>
</section>

<section class="info-section">
    <div class="info-card" data-bs-toggle="modal" data-bs-target="#modalAdmin">
        <h3>Untuk Admin</h3>
        <p>Mengelola data pengguna, lowongan kerja, dan proses seleksi dengan sistem yang terpusat dan mudah digunakan.</p>
    </div>
    <div class="info-card" data-bs-toggle="modal" data-bs-target="#modalDepartemen">
        <h3>Untuk Departemen</h3>
        <p>Unggah dan kelola lowongan pekerjaan sesuai kebutuhan departemen.</p>
    </div>
    <div class="info-card" data-bs-toggle="modal" data-bs-target="#modalPelamar">
        <h3>Untuk Pelamar</h3>
        <p>Daftar dan buat profil Anda, lamar pekerjaan sesuai keahlian, dan ikuti proses seleksi secara online.</p>
    </div>
</section>

<!-- Modal Admin -->
<div class="modal fade" id="modalAdmin" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informasi untuk Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Mengelola keseluruhan sistem: data pengguna, perusahaan, lowongan, periode, dan proses seleksi.
      </div>
    </div>
  </div>
</div>

<!-- Modal Departemen -->
<div class="modal fade" id="modalDepartemen" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informasi untuk Departemen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Menambahkan lowongan pekerjaan sesuai kebutuhan departemen masing-masing.
      </div>
    </div>
  </div>
</div>

<!-- Modal Pelamar -->
<div class="modal fade" id="modalPelamar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informasi untuk Pelamar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Pelamar dapat membuat profil lengkap, mengunggah CV, melihat lowongan yang tersedia, melamar pekerjaan sesuai keahlian, serta mengikuti semua tahapan seleksi secara online.
      </div>
    </div>
  </div>
</div>

<footer>
    &copy; <?= date('Y') ?> Portal Lowongan Kerja - Asludin Azami. All rights reserved.
</footer>

</body>
</html>
