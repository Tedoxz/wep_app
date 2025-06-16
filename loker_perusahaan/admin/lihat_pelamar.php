<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

echo '<link rel="stylesheet" href="../assets/css/admin/lihat_pelamar.css">';

if (!isset($_GET['id_lowongan'])) {
    echo "<script>alert('ID lowongan tidak ditemukan'); window.location='data_lowongan.php';</script>";
    exit;
}

$id_lowongan = intval($_GET['id_lowongan']);

// Ambil data pelamar beserta status lamarannya
$query = "
    SELECT 
        lam.id_pelamar,
        p.nama, 
        p.email, 
        p.no_hp, 
        l.posisi, 
        lam.status
    FROM lamaran lam
    JOIN pelamar p ON lam.id_pelamar = p.id_pelamar
    JOIN lowongan l ON lam.id_lowongan = l.id_lowongan
    WHERE lam.id_lowongan = $id_lowongan
";
$result = mysqli_query($koneksi, $query);
?>

<div class="container">
    <h2>Daftar Pelamar</h2>
    <a class="back-link" href="data_lowongan.php">← Kembali ke Data Lowongan</a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Posisi Dilamar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['no_hp'] ?></td>
                            <td><?= $row['posisi'] ?></td>
                            <td>
                                <form action="ubah_status.php" method="POST">
                                    <input type="hidden" name="id_pelamar" value="<?= $row['id_pelamar'] ?>">
                                    <input type="hidden" name="id_lowongan" value="<?= $id_lowongan ?>">
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="daftar" <?= $row['status'] == 'daftar' ? 'selected' : '' ?>>Daftar</option>
                                        <option value="seleksi" <?= $row['status'] == 'seleksi' ? 'selected' : '' ?>>Seleksi</option>
                                        <option value="diterima" <?= $row['status'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                        <option value="ditolak" <?= $row['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada pelamar untuk lowongan ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
