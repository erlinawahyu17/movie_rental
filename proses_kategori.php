<?php
include "config.php";

$nama = $_POST['nama_kategori'];

if (!empty($nama)) {
    $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama')";
    if (mysqli_query($conn, $query)) {
        header("Location: kategori.php");
    } else {
        echo "Gagal menambahkan kategori: " . mysqli_error($conn);
    }
} else {
    echo "Nama kategori tidak boleh kosong.";
}
?>                                      