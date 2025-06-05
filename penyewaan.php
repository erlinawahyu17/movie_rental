<?php
require_once 'config.php';
?>

<table class="table table-hover">
  <thead>
    <tr class="text-center">
      <th>No</th>
      <th>Nama Pelanggan</th>
      <th>Film ID</th>
      <th>Tanggal Sewa</th>
      <th>Tanggal Kembali</th>
      <th>Aksi</th> <!-- Tambah kolom aksi -->
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $result = mysqli_query($conn, "SELECT * FROM penyewaan");
    while ($penyewaan = mysqli_fetch_assoc($result)) {
      echo "<tr class='text-center'>
              <td>{$no}</td>
              <td>{$penyewaan['nama_pelanggan']}</td>
              <td>{$penyewaan['film_id']}</td>
              <td>{$penyewaan['tanggal_sewa']}</td>
              <td>{$penyewaanw['tanggal_kembali']}</td>
              <td>
                <a href='edit_penyewaan.php?id={$penyewaan['id']}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='hapus_penyewaan.php?id={$penyewaan['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin hapus data penyewaan ini?');\">Hapus</a>
              </td>
            </tr>";
      $no++;
    }
    ?>
  </tbody>
</table>