<?php
include 'config.php';

if (!isset($_GET['id'])) {
  die("Parameter tidak ditemukan.");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM film WHERE film_id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  die("Data tidak ditemukan.");
}

if (isset($_POST['update'])) {
  $judul_film = mysqli_real_escape_string($conn, $_POST['judul_film']);
  $genre = mysqli_real_escape_string($conn, $_POST['genre']);
  $tahun_rilis = mysqli_real_escape_string($conn, $_POST['tahun_rilis']);

  $update = mysqli_query($conn, "UPDATE film SET 
    judul_film='$judul_film',
    genre='$genre',
    tahun_rilis='$tahun_rilis'
    WHERE film_id='$id'");

  if ($update) {
    header("Location: film.php");
    exit;
  } else {
    echo "Gagal update data: " . mysqli_error($conn);
  }
}
?>