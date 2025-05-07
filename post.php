php
<?php include "config.php"; ?>
<h2>Data Film</h2>
<form method="POST" action="proses_post.php">
    Judul: <input name="judul"><br>
    Genre: <input name="genre"><br>
    Tahun: <input name="tahun"><br>
    <button type="submit">Simpan</button>
</form>

<?php
$result = $conn->query("SELECT * FROM film");
echo "<table border='1'><tr><th>Judul</th><th>Genre</th><th>Tahun</th><th>Aksi</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['judul']}</td>
        <td>{$row['genre']}</td>
        <td>{$row['tahun']}</td>
        <td>
            <a href='edit_post.php?id={$row['id']}'>Edit</a> | 
            <a href='hapus_post.php?id={$row['id']}'>Hapus</a>
        </td>
    </tr>";
}
echo "</table>";
?>


