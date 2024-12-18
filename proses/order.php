<?php
// Nomor WhatsApp tujuan
$nomor_wa = '6285156022194'; // Ganti dengan nomor WhatsApp tujuan

// Ambil data dari URL parameter
$foto = isset($_GET['foto']) ? $_GET['foto'] : '';
$kode = isset($_GET['kode']) ? $_GET['kode'] : '';

// Buat pesan yang akan dikirimkan
$pesan = "Hi, saya ingin pesan produk berikut:\n";
$pesan .= "Kode Produk: " . $kode . "\n";
$pesan .= "Lihat foto produk di sini: [URL_FOTO]";

// Ganti [URL_FOTO] dengan path lengkap foto produk
$url_foto = "https://yourdomain.com/photo/" . urlencode($foto); // Ganti 'yourdomain.com' dengan domain Anda
$pesan = str_replace("[URL_FOTO]", $url_foto, $pesan);

// Encode pesan untuk URL WhatsApp
$pesan_terencode = urlencode($pesan);

// Buat URL WhatsApp
$url_whatsapp = "https://wa.me/$nomor_wa?text=$pesan_terencode";

// Redirect ke WhatsApp
header("Location: $url_whatsapp");
exit();
?>

