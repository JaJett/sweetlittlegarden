<?php
    include "../koneksi/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $posisi = $_POST['posisi'];

    $sql = "INSERT INTO admin (nama, username, password, posisi) VALUES ('$nama', '$username', '$password', '$posisi')";
    if (mysqli_query($db, $sql)) {
        header("location:../view/index.php");
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($db) . "</div>";
    }
}
?>