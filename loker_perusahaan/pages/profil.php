<?php
session_start();
include('../config/koneksi.php');


// Link ke CSS eksternal
echo '<link rel="stylesheet" href="../assets/css/profil.css">';

// Ambil data profil perusahaan
$query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$data = mysqli_fetch_assoc($query);
?>

<div class="profil-container">
    <h2>Profil Perusahaan</h2>
    <div class="profil-card">
        <img class="logo" src="../assets/img/<?= htmlspecialchars($data['logo']) ?>" alt="Logo Perusahaan">
        <div class="profil-info">
            <p><strong>Nama:</strong> <?= htmlspecialchars($data['nama']) ?></p>
            <p><strong>Alamat:</strong> <?= nl2br(htmlspecialchars($data['alamat'])) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></p>
            <p><strong>Telepon:</strong> <?= htmlspecialchars($data['telepon']) ?></p>
            <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>

            <?php if (isset($_SESSION['akses']) && $_SESSION['akses'] == 'admin'): ?>
                <a href="edit_profil.php?id=<?= $data['id'] ?>" class="btn-edit">Edit Profil</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
