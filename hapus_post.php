<?php
include "config.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM film WHERE film_id = '$id'");

header("Location: posts.php");
?>