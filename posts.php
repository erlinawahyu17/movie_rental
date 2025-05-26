<?php
include '.includes/header.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_film.php">
                        <!-- Nomor -->
                        <div class="mb-3">
                            <label for="no" class="form-label">No</label>
                            <input type="text" class="form-control" name="no" required>
                        </div>

                        <!-- Film ID -->
                        <div class="mb-3">
                            <label for="film_id" class="form-label">Film ID</label>
                            <input type="text" class="form-control" name="film_id" required>
                        </div>

                        <!-- Judul Film -->
                        <div class="mb-3">
                            <label for="judul_film" class="form-label">Judul Film</label>
                            <input type="text" class="form-control" name="judul_film" required>
                        </div>

                        <!-- Genre -->
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <textarea class="form-control" name="genre" required></textarea>
                        </div>

                        <!-- Tahun Rilis -->
                        <div class="mb-3">
                            <label for="tahun_rilis" class="form-label">Tahun Rilis</label>
                            <input type="number" class="form-control" name="tahun_rilis" min="1900" max="2099" required>
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '.includes/footer.php';
?>