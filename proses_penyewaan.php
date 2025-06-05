<?php
require_once 'config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_pelanggan'];
    $film_id = $_POST['film_id'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query = "INSERT INTO penyewaan (nama_pelanggan, film_id, tanggal_sewa, tanggal_kembali) 
              VALUES ('$nama', '$film_id', '$tanggal_sewa', '$tanggal_kembali')";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php?success=1");
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>