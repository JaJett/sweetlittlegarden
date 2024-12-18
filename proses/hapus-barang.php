<?php
include '../koneksi/koneksi.php'; // Koneksi ke database

if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];

    // Cari file foto barang berdasarkan ID
    $query = "SELECT foto FROM barang WHERE id_barang = '$id_barang'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto = $row['foto'];

        // Hapus file foto dari folder (jika ada)
        if ($foto !== '-' && file_exists("../photo/$foto")) {
            unlink("../photo/$foto");
        }

        // Hapus data barang dari database
        $deleteQuery = "DELETE FROM barang WHERE id_barang = '$id_barang'";
        if ($db->query($deleteQuery) === TRUE) {
            header("Location: ../view/index.php?message=deleted");
        } else {
            echo "Error: " . $db->error;
        }
    } else {
        echo "Data barang tidak ditemukan.";
    }
} else {
    echo "ID barang tidak diberikan.";
}
?>
