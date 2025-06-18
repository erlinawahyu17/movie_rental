<?php
require_once 'config.php';
include '.includes/header.php';
$title = "Edit Penyewaan";
include '.includes/toast_notification.php';

// Validasi parameter
if (!isset($_GET['penyewaan_id'])) {
    echo "<script>alert('ID penyewaan tidak ditemukan');window.location='dashboard.php';</script>";
    exit;
}

$penyewaan_id = $_GET['penyewaan_id'];

// Ambil data penyewaan
$result = mysqli_query($conn, "SELECT * FROM penyewaan WHERE penyewaan_id = '$penyewaan_id'");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data penyewaan tidak ditemukan');window.location='dashboard.php';</script>";
    exit;
}

// Ambil daftar film
$film = mysqli_query($conn, "SELECT * FROM film");

// Form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $film_id = $_POST['film_id'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query = "UPDATE penyewaan SET 
                nama_pelanggan = '$nama_pelanggan',
                film_id = '$film_id',
                tanggal_sewa = '$tanggal_sewa',
                tanggal_kembali = '$tanggal_kembali'
              WHERE penyewaan_id = '$penyewaan_id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui');window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Data Penyewaan</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post">
                <!-- Nama Pelanggan Manual -->
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" value="<?= htmlspecialchars($data['nama_pelanggan']) ?>" required>
                </div>

                <!-- Film -->
                <div class="mb-3">
                    <label for="film_id" class="form-label">Judul Film</label>
                    <select name="film_id" class="form-select" required>
                        <option value="">-- Pilih Film --</option>
                        <?php while ($f = mysqli_fetch_assoc($film)) {
                            $selected = $f['film_id'] == $data['film_id'] ? 'selected' : '';
                            echo "<option value='{$f['film_id']}' $selected>{$f['judul_film']}</option>";
                        } ?>
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                    <input type="date" name="tanggal_sewa" class="form-control" value="<?= $data['tanggal_sewa'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" value="<?= $data['tanggal_kembali'] ?>" required>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="dashboard.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include '.includes/footer.php'; ?>
