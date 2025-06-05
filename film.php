<?php
include '.includes/header.php';
require_once 'config.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Data Tambah Film -->
    <div class="card mb-4">
        <h5 class="card-header">Tambah Film</h5>
        <div class="card-body">
            <form action="proses_film.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Judul Film</label>
                    <input type="text" name="judul_film" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" name="genre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Rilis</label>
                    <input type="number" name="tahun_rilis" class="form-control" required>
                </div>

                <button type="submit" name="tambah" class="btn btn-success">Tambah Film</button>
            </form>
        </div>
    </div>

    <!-- Daftar Semua Film -->
    <div class="card mb-4">
        <h5 class="card-header">Daftar Semua Film</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Film ID</th>
                            <th>Judul</th>
                            <th>Genre</th>
                            <th>Tahun Rilis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $result = mysqli_query($conn, "SELECT * FROM film");
                        while ($film = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$film['id']}</td>
                                    <td>{$film['judul_film']}</td>
                                    <td>{$film['genre']}</td>
                                    <td>{$film['tahun_rilis']}</td>
                                    <td>
                                        <a href='edit_film.php?id={$film['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='hapus_film.php?id={$film['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin hapus film ini?');\">Hapus</a>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '.includes/footer.php'; ?>