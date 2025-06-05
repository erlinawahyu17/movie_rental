<?php
require_once 'config.php';
include(".includes/header.php");
$title = "Dashboard";
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- SECTION: Data Penyewaan Film -->
    <div class="card">
        <div class="card-header">
            <h5>Data Penyewaan Film</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Judul Film</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT penyewaan.*, film.judul_film 
                                  FROM penyewaan 
                                  JOIN film ON penyewaan.film_id = film.film_id";
                        $result = mysqli_query($conn, $query);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) :
                            $penyewaan_id = $row['penyewaan_id']; // pastikan kolom ini ada di tabel penyewaan
                        ?>
                        <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_pelanggan']; ?></td>
                            <td><?= $row['judul_film']; ?></td>
                            <td><?= $row['tanggal_sewa']; ?></td>
                            <td><?= $row['tanggal_kembali']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="edit_film.php?penyewaan_id=<?= $penyewaan_id; ?>">
                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deletePenyewaan_<?= $penyewaan_id; ?>">
                                            <i class="bx bx-trash me-2"></i> Hapus
                                        </a>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="deletePenyewaan_<?= $penyewaan_id; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="proses_penyewaan.php" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Yakin ingin menghapus penyewaan oleh <strong><?= $row['nama_pelanggan']; ?></strong>?</p>
                                                    <input type="hidden" name="penyewaan_id" value="<?= $penyewaan_id; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include(".includes/footer.php"); ?>