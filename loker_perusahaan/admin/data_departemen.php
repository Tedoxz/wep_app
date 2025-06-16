<?php
include '../config/koneksi.php';
include('../includes/auth/admin.php');
include '../includes/header.php';

// Tambah link ke CSS
echo '<link rel="stylesheet" href="../assets/css/admin/data_departemen.css">';

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $inisial = mysqli_real_escape_string($koneksi, $_POST['inisial']);
    $id_user = (int)$_POST['id_user'];

    $query = "INSERT INTO department (nama, inisial, id_user) VALUES ('$nama', '$inisial', '$id_user')";
    mysqli_query($koneksi, $query);
    echo "<script>alert('Departemen berhasil ditambahkan');window.location='data_departemen.php';</script>";
}
?>

<div class="container">
    <h2>Data Departemen</h2>
    <a href="../pages/dashboard_admin.php">← Kembali ke Dashboard</a><br><br>
    <form method="post" class="form-box">
        <label>Nama Departemen</label>
        <input type="text" name="nama" required>

        <label>Inisial</label>
        <input type="text" name="inisial" required>

        <label>User Login (Departemen)</label>
        <select name="id_user" required>
            <option value="">-- Pilih User --</option>
            <?php
            $user_query = mysqli_query($koneksi, "SELECT * FROM user WHERE akses = 'departemen'");
            while ($user = mysqli_fetch_assoc($user_query)) {
                echo "<option value='{$user['id_user']}'>{$user['user']}</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn-primary">Simpan</button>
    </form>

    <hr>

    <h3>Daftar Departemen</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Inisial</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $departemen = mysqli_query($koneksi, "SELECT d.*, u.user FROM department d LEFT JOIN user u ON d.id_user = u.id_user");
                while ($d = mysqli_fetch_assoc($departemen)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$d['nama']}</td>
                            <td>{$d['inisial']}</td>
                            <td>{$d['user']}</td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
