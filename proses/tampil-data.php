<?php
include "../Koneksi/koneksi.php";
$data = mysqli_query($db, "SELECT * FROM barang");
return $data;
