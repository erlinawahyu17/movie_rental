<?php
// Menghubungkan file konfigurasi database
include '.includes/header.php';


// Memulai sesi
session_start();

// Mendapatkan ID user dari session (opsional, kalau memang dibutuhkan)
$userID = $_SESSION["user_id"] ?? null;

// Proses simpan data film
if (isset($_POST['simpan'])) {
    $no = $_POST['no'];
    $film_id = $_POST['film_id'];
    $judul_film = $_POST['judul_film'];
    $genre = $_POST['genre'];
    $tahun_rilis = $_POST['tahun_rilis'];

    // Query insert ke tabel film (gantilah 'films' jika nama tabel berbeda)
    $query = "INSERT INTO films (no, film_id, judul_film, genre, tahun_rilis) VALUES 
              ('$no', '$film_id', '$judul_film', '$genre', '$tahun_rilis')";

    if ($conn->query($query) === TRUE) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Film berhasil ditambahkan.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menambahkan film: ' . $conn->error
        ];
    }

    header('Location: dashboard.php');
    exit();
}

// Tambahan jika suatu saat butuh hapus film:
if (isset($_POST['delete'])) {
    $filmId = $_POST['film_id'];

    $exec = mysqli_query($conn, "DELETE FROM films WHERE film_id = '$filmId'");

    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Film berhasil dihapus.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menghapus film: ' . mysqli_error($conn)
        ];
    }

    header('Location: dashboard.php');
    exit();
}