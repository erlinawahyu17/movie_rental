<?php
include 'config.php';

if (!isset($_GET['id'])) {
  die("Parameter tidak ditemukan.");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM penyewaan WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  die("Data tidak ditemukan.");
}

if (isset($_POST['update'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
  $film_id = mysqli_real_escape_string($conn, $_POST['film_id']);
  $tanggal_sewa = mysqli_real_escape_string($conn, $_POST['tanggal_sewa']);
  $tanggal_kembali = mysqli_real_escape_string($conn, $_POST['tanggal_kembali']);

  $update = mysqli_query($conn, "UPDATE penyewaan SET 
    nama_pelanggan='$nama',
    film_id='$film_id',
    tanggal_sewa='$tanggal_sewa',
    tanggal_kembali='$tanggal_kembali'
    WHERE id='$id'");

  if ($update) {
    header("Location: penyewaan.php");
    exit;
  } else {
    echo "Gagal update data: " . mysqli_error($conn);
  }
}
?>

<h3>Edit Penyewaan</h3>
<form method="POST" action="">
  <label>Nama Pelanggan</label><br>
  <input type="text" name="nama_pelanggan" value="<?= htmlspecialchars($data['nama_pelanggan']) ?>" required><br>

  <label>Film ID</label><br>
  <input type="text" name="film_id" value="<?= htmlspecialchars($data['film_id']) ?>" required><br>

  <label>Tanggal Sewa</label><br>
  <input type="date" name="tanggal_sewa" value="<?= htmlspecialchars($data['tanggal_sewa']) ?>" required><br>

  <label>Tanggal Kembali</label><br>
  <input type="date" name="tanggal_kembali" value="<?= htmlspecialchars($data['tanggal_kembali']) ?>" required><br><br>

  <button type="submit" name="update">Update</button>
</form>