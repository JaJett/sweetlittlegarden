<?php
include "../koneksi/koneksi.php";

$id_barang = $_POST['id_barang'];
$kategori = $_POST['kategori'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$ket = $_POST['ket'];

if (isset($_POST['update'])) {
    extract($_POST);
    $nama_file = $_FILES['foto']['name'];

    if (!empty($nama_file)) {
        // Baca lokasi file sementara dan nama file dari form (upload)
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
        $file_foto = $id_barang . "." . $tipe_file;

        // Tentukan folder untuk menyimpan file
        $folder = "../photo/$file_foto";
        @unlink($folder); // Hapus file lama jika ada
        // Apabila file berhasil di-upload
        move_uploaded_file($lokasi_file, "$folder");
    } else {
        $file_foto = "$foto_awal";
    }

    $sql = "UPDATE barang SET kategori='$kategori', nama='$nama', harga='$harga', ket='$ket', foto='$file_foto' WHERE id_barang='$id_barang'";
    $qry = mysqli_query($db, $sql);

    header("location:../view/index.php?page=dashboard");
}
?>
