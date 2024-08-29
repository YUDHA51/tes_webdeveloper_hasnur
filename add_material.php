<?php
include 'db/connection.php';

// Cek apakah ada ID kursus yang dikirim melalui URL
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Proses ketika form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $embed_link = $_POST['embed_link'];

        // Menambahkan materi baru ke dalam tabel materials
        $sql = "INSERT INTO materials (course_id, title, description, embed_link) VALUES ('$course_id', '$title', '$description', '$embed_link')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: course_details.php?id=$course_id"); // Kembali ke halaman detail kursus
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "ID kursus tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Materi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Tambah Materi</h1>
    <form action="add_material.php?course_id=<?= $course_id ?>" method="POST">
        <label for="title">Judul Materi:</label>
        <input type="text" name="title" required><br>
        <label for="description">Deskripsi:</label>
        <textarea name="description" required></textarea><br>
        <label for="embed_link">Link Embed Materi:</label>
        <input type="text" name="embed_link" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
