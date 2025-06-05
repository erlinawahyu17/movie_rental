<?php
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['tambah'])) {
    $judul_film = mysqli_real_escape_string($conn, $_POST['judul_film']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $tahun_rilis = mysqli_real_escape_string($conn, $_POST['tahun_rilis']);

    $query = "INSERT INTO film (judul_film, genre, tahun_rilis) VALUES ('$judul_film', '$genre', '$tahun_rilis')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: film.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal menambahkan film: " . mysqli_error($conn) . "</div>";
    }
}
?>