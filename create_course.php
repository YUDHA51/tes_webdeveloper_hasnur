<?php
include 'db/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO courses (title, description, duration) VALUES ('$title', '$description', '$duration')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kursus Baru</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Tambah Kursus Baru</h1>
    <form action="create_course.php" method="POST">
        <label for="title">Judul:</label>
        <input type="text" name="title" required><br>
        <label for="description">Deskripsi:</label>
        <textarea name="description" required></textarea><br>
        <label for="duration">Durasi:</label>
        <input type="text" name="duration" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
