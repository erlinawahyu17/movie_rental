<?php
require_once 'config.php';

// Aktifkan error log saat debugging (opsional, bisa dihapus di produksi)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // PROSES HAPUS
    if (isset($_POST['delete']) && isset($_POST['penyewaan_id'])) {
        $penyewaan_id = intval($_POST['penyewaan_id']);

        // Cek apakah data ada
        $cek = mysqli_query($conn, "SELECT * FROM penyewaan WHERE penyewaan_id = $penyewaan_id");
        if (mysqli_num_rows($cek) === 0) {
            echo "<script>alert('Data tidak ditemukan');window.location='dashboard.php';</script>";
            exit;
        }

        // Proses hapus
        $hapus = mysqli_query($conn, "DELETE FROM penyewaan WHERE penyewaan_id = $penyewaan_id");

        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus');window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data: " . mysqli_error($conn) . "');window.location='dashboard.php';</script>";
        }
        exit;
    }

    // PROSES TAMBAH
    if (isset($_POST['nama_pelanggan'], $_POST['film_id'], $_POST['tanggal_sewa'], $_POST['tanggal_kembali'])) {
        $nama_pelanggan = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
        $film_id = intval($_POST['film_id']);
        $tanggal_sewa = $_POST['tanggal_sewa'];
        $tanggal_kembali = $_POST['tanggal_kembali'];

        // Tambahkan pelanggan jika belum ada
        $cek_pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama_pelanggan = '$nama_pelanggan'");
        if (mysqli_num_rows($cek_pelanggan) === 0) {
            mysqli_query($conn, "INSERT INTO pelanggan (nama_pelanggan) VALUES ('$nama_pelanggan')");
        }

        // Tambah penyewaan
        $query = "INSERT INTO penyewaan (nama_pelanggan, film_id, tanggal_sewa, tanggal_kembali)
                  VALUES ('$nama_pelanggan', '$film_id', '$tanggal_sewa', '$tanggal_kembali')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data penyewaan berhasil ditambahkan');window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan penyewaan: " . mysqli_error($conn) . "');window.history.back();</script>";
        }
        exit;
    }

    // Jika tidak sesuai
    echo "<script>alert('Permintaan tidak dikenali');window.location='dashboard.php';</script>";
}
?>
