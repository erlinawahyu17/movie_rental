<?php
include 'config.php';

if (!isset($_GET['id'])) {
  die("Parameter tidak ditemukan.");
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM film WHERE film_id='$id'"));

if (!$data) {
  die("Data tidak ditemukan.");
}
?>

<h3>Edit Film</h3>
<form method="POST" action="edit_film.php?id=<?= $id ?>">
  <label>Judul Film</label><br>
  <input type="text" name="judul_film" value="<?= htmlspecialchars($data['judul_film']) ?>" required><br>

  <label>Genre</label><br>
  <input type="text" name="genre" value="<?= htmlspecialchars($data['genre']) ?>" required><br>

  <label>Tahun Rilis</label><br>
  <input type="number" name="tahun_rilis" value="<?= htmlspecialchars($data['tahun_rilis']) ?>" required><br><br>

  <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
  $judul_film = $_POST['judul_film'];
  $genre = $_POST['genre'];
  $tahun_rilis = $_POST['tahun_rilis'];

  $update = mysqli_query($conn, "UPDATE film SET 
    judul_film='$judul_film', genre='$genre', tahun_rilis='$tahun_rilis'
    WHERE film_id='$id'");

  if ($update) {
    header("Location: film.php");
    exit;
  } else {
    echo "Gagal update data: " . mysqli_error($conn);
  }
}
?>
