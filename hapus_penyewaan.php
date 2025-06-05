<?php
include 'config.php';

if (!isset($_GET['id'])) {
  die("Parameter tidak ditemukan.");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM penyewaan WHERE id = '$id'");

if ($query) {
  header("Location: penyewaan.php");
  exit;
} else {
  echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>