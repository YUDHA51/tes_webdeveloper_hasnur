<?php
include 'db/connection.php';

// Mengambil daftar kursus
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Sederhana</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirmDelete(courseName) {
            return confirm('Apakah Anda yakin ingin menghapus kursus "' + courseName + '" ini?');
        }
    </script>
</head>
<body>
    <div class="course-list">
        <h1>Website Sederhana</h1>
        <h1>Daftar Course</h1>
        <a href="create_course.php" class="add-course-button">Tambah Course Baru</a>
        <table class="course-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['duration']) ?></td>
                        <td class="action-buttons">
                            <a href="course_details.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-detail">Detail</a> | 
                            <a href="edit_course.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-edit">Edit</a> | 
                            <a href="delete_course.php?id=<?= $row['id'] ?>&title=<?= urlencode($row['title']) ?>" class="btn btn-primary btn-delete" onclick="return confirmDelete('<?= addslashes($row['title']) ?>')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 PHP & OPENAI. All rights reserved.</p>
    </footer>
</body>
</html>
