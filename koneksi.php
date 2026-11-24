<?php
// Pengaturan Koneksi Database SIMRS
$host     = "localhost";
$user     = "meyyum";
$pass     = "smkn3tbn"; // Sesuaikan jika server hosting menggunakan password
$database = "db_rekam_medis";

try {
    $koneksi = mysqli_connect($host, $user, $pass, $database);
    if (!$koneksi) {
        throw new Exception(mysqli_connect_error());
    }
} catch (Exception $e) {
    die("<div style='padding: 20px; font-family: sans-serif; background:#fee2e2; color:#991b1b; border-radius:8px; margin:20px;'>
        <h3><i class='fa-solid fa-triangle-exclamation'></i> Koneksi Database Gagal</h3>
        <p>Pesan Kesalahan: <strong>" . $e->getMessage() . "</strong></p>
        <hr>
        <small>Pastikan MySQL server sudah berjalan dan database <code>db_rekam_medis</code> telah di-import di phpMyAdmin.</small>
    </div>");
}
?>