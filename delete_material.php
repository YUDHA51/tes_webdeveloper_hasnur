<?php
include 'db/connection.php';

// Memeriksa apakah ID materi dikirim melalui URL
if (isset($_GET['id'])) {
    $material_id = $_GET['id'];

    // Menghapus materi berdasarkan ID
    $delete_sql = "DELETE FROM materials WHERE id = '$material_id'";

    if ($conn->query($delete_sql) === TRUE) {
        // Jika berhasil, kembali ke halaman detail kursus
        header("Location: course_details.php?id=" . $_GET['course_id']);
        exit;
    } else {
        echo "Gagal menghapus materi: " . $conn->error;
    }
} else {
    echo "ID materi tidak ditemukan.";
    exit;
}
?>
