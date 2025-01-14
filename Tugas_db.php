<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'tracer_alumni';

try {
    // Membuat koneksi PDO
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Aktifkan error handling
} catch (PDOException $e) {
    // Tangani kesalahan koneksi
    die("Koneksi gagal: " . $e->getMessage());
}
?>
