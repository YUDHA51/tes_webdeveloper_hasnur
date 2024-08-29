<?php
include 'db/connection.php';

// Cek apakah ada ID materi yang dikirim melalui URL
if (isset($_GET['id'])) {
    $material_id = $_GET['id'];

    // Ambil data materi berdasarkan ID
    $material_sql = "SELECT * FROM materials WHERE id = '$material_id'";
    $material_result = $conn->query($material_sql);

    if ($material_result && $material_result->num_rows > 0) {
        $material = $material_result->fetch_assoc();
        $course_id = $material['course_id']; // Simpan ID kursus untuk kembali ke halaman detail kursus
    } else {
        echo "Materi tidak ditemukan.";
        exit;
    }

    // Proses ketika form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $embed_link = $_POST['embed_link'];

        // Update data materi
        $update_sql = "UPDATE materials SET title='$title', description='$description', embed_link='$embed_link' WHERE id='$material_id'";
        
        if ($conn->query($update_sql) === TRUE) {
            header("Location: course_details.php?id=" . $course_id); // Kembali ke halaman detail kursus
            exit;
        } else {
            echo "Error: " . $update_sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "ID materi tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Materi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Materi</h1>
    <form action="edit_material.php?id=<?= $material_id ?>" method="POST">
        <label for="title">Judul Materi:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($material['title']) ?>" required><br>
        <label for="description">Deskripsi:</label>
        <textarea name="description" required><?= htmlspecialchars($material['description']) ?></textarea><br>
        <label for="embed_link">Link Embed Materi:</label>
        <input type="text" name="embed_link" value="<?= htmlspecialchars($material['embed_link']) ?>" required><br>
        <div class="form-buttons">
            <button type="submit">Simpan</button>
            <a href="course_details.php?id=<?= $material['course_id'] ?>" class="back-button">Kembali</a>
        </div>
    </form>
</body>
</html>
