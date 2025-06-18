<?php
require_once 'config.php';
include '.includes/header.php';
$title = "Form Penyewaan";
include '.includes/toast_notification.php';

$film = mysqli_query($conn, "SELECT * FROM film");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pelanggan = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
    $film_id = $_POST['film_id'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $cek = mysqli_query($conn, "SELECT nama_pelanggan FROM pelanggan WHERE nama_pelanggan = '$nama_pelanggan'");
    if (mysqli_num_rows($cek) == 0) {
        mysqli_query($conn, "INSERT INTO pelanggan (nama_pelanggan) VALUES ('$nama_pelanggan')");
    }

    $query = "INSERT INTO penyewaan (nama_pelanggan, film_id, tanggal_sewa, tanggal_kembali) 
              VALUES ('$nama_pelanggan', '$film_id', '$tanggal_sewa', '$tanggal_kembali')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data penyewaan berhasil ditambahkan');window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan penyewaan');</script>";
    }
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Tambah Penyewaan</h4>
    <div class="card mb-4">
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="film_id" class="form-label">Pilih Film</label>
                    <select name="film_id" class="form-select" required>
                        <option value="">-- Pilih Film --</option>
                        <?php while ($row = mysqli_fetch_assoc($film)) {
                            echo "<option value='{$row['film_id']}' data-genre='{$row['genre']}'>{$row['judul_film']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" id="genre" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                    <input type="date" name="tanggal_sewa" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelector('select[name="film_id"]').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const genre = selectedOption.getAttribute('data-genre');
    document.getElementById('genre').value = genre || '';
});
</script>

<?php include '.includes/footer.php'; ?>
