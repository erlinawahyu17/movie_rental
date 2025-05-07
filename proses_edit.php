<?php
include "config.php";

$id = $_POST['id'];
$judul = $_POST['judul_film'];
$genre = $_POST['genre'];
$tahun = $_POST['tahun_rilis'];

$query = "UPDATE film SET judul_film='$judul', genre='$genre', tahun_rilis='$tahun' WHERE film_id='$id'";
mysqli_query($conn, $query);

header("Location: posts.php");
?>