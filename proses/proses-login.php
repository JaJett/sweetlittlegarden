<?php
session_start();
include '../koneksi/koneksi.php'; // Pastikan file koneksi sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = $_POST['password'];

    // Query ke database untuk cek username
    $stmt = $db->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data user ke session
            $_SESSION['username'] = $user['username'];
            $_SESSION['posisi'] = $user['posisi']; // owner atau admin

            // Redirect ke dashboard
            header('Location: ../view/dashboard.php');
            exit;
        } else {
            // Jika password salah, kembali ke halaman login dengan pesan error
            $_SESSION['message'] = "Password salah!";
            header('Location: ../view/login.php');
            exit;
        }
    } else {
        // Jika username tidak ditemukan, kembali ke halaman login dengan pesan error
        $_SESSION['message'] = "Username tidak ditemukan!";
        header('Location: ../view/login.php');
        exit;
    }
}
?>
