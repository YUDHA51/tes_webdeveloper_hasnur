<?php
$servername = "localhost";
$username = "root"; // Sesuaikan dengan konfigurasi server
$password = "";
$dbname = "online_course";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>
