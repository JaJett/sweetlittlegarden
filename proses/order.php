<?php

// Nomor WhatsApp tujuan (gunakan format internasional tanpa tanda '+' atau '0' di awal)
$nomor_wa = '6285156022194'; // Ganti dengan nomor WhatsApp tujuan

// Pesan default yang akan dikirim
$pesan = 'Hi, saya ingin pesan.'; // Ganti dengan pesan yang Anda inginkan

// Encode pesan agar sesuai dengan URL
$pesan_terencode = urlencode($pesan);

// Buat URL direct link ke WhatsApp
$url_whatsapp = "https://wa.me/$nomor_wa?text=$pesan_terencode";

// Redirect pengguna ke URL WhatsApp
header("Location: $url_whatsapp");
exit();

?>
