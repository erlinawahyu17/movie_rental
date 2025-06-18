<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $cek = mysqli_query($conn, "SELECT * FROM penyewaan WHERE penyewaan_id = $id");

    if (mysqli_num_rows($cek) === 0) {
        echo "<script>alert('Data tidak ditemukan');window.location='dashboard.php';</script>";
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM penyewaan WHERE penyewaan_id = $id");
        echo $hapus ?
            "<script>alert('Data berhasil dihapus');window.location='dashboard.php';</script>" :
            "<script>alert('Gagal menghapus data');window.location='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Akses tidak sah');window.location='dashboard.php';</script>";
}
?>