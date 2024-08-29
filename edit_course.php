<?php
include 'db/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM courses WHERE id=$id";
    $result = $conn->query($sql);
    $course = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $sql = "UPDATE courses SET title='$title', description='$description', duration='$duration' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Course</h1>
    <form action="edit_course.php" method="POST">
        <input type="hidden" name="id" value="<?= $course['id'] ?>">
        <label for="title">Judul:</label>
        <input type="text" name="title" value="<?= $course['title'] ?>" required><br>
        <label for="description">Deskripsi:</label>
        <textarea name="description" required><?= $course['description'] ?></textarea><br>
        <label for="duration">Durasi:</label>
        <input type="text" name="duration" value="<?= $course['duration'] ?>" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
