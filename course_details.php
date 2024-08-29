<?php
include 'db/connection.php';

// Cek apakah ada ID kursus yang dikirim melalui URL
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Mengambil data kursus berdasarkan ID
    $course_sql = "SELECT * FROM courses WHERE id = '$course_id'";
    $course_result = $conn->query($course_sql);

    // Periksa apakah data kursus ditemukan
    if ($course_result && $course_result->num_rows > 0) {
        $course = $course_result->fetch_assoc();
    } else {
        echo "Kursus tidak ditemukan atau query gagal.";
        exit;
    }

    // Mengambil semua materi yang terkait dengan kursus
    $materials_sql = "SELECT * FROM materials WHERE course_id = '$course_id'";
    $materials_result = $conn->query($materials_sql);

    if (!$materials_result) {
        echo "Gagal mengambil data materi.";
        exit;
    }

} else {
    echo "ID kursus tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Course</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirmDelete(materialName) {
            return confirm('Apakah Anda yakin ingin menghapus materi "' + materialName + '" ini?');
        }
    </script>
</head>
<body>
    <div class="course-details">
        <h1>Detail Course</h1>
        
        <!-- Kotak untuk informasi kursus -->
        <div class="course-info">
            <table>
                <tr>
                    <td><strong>Judul:</strong></td>
                    <td><?= isset($course['title']) ? htmlspecialchars($course['title']) : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Deskripsi:</strong></td>
                    <td><?= isset($course['description']) ? htmlspecialchars($course['description']) : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Durasi:</strong></td>
                    <td><?= isset($course['duration']) ? htmlspecialchars($course['duration']) : 'N/A' ?> menit</td>
                </tr>
            </table>
        </div>

        <a href="add_material.php?course_id=<?= $course['id'] ?>" class="btn btn-blue">Tambah Materi</a>

        <?php if ($materials_result && $materials_result->num_rows > 0): ?>
            <table class="material-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Link Materi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($material = $materials_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($material['title']) ?></td>
                            <td><?= htmlspecialchars($material['description']) ?></td>
                            <td><a href="<?= htmlspecialchars($material['embed_link']) ?>" class="btn btn-blue" target="_blank">Lihat Materi</a></td>
                            <td>
                                <a href="edit_material.php?id=<?= $material['id'] ?>" class="btn btn-edit">Edit</a> | 
                                <a href="delete_material.php?id=<?= $material['id'] ?>&course_id=<?= $course['id'] ?>" class="btn btn-delete" onclick="return confirmDelete('<?= addslashes($material['title']) ?>')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada materi untuk kursus ini.</p>
        <?php endif; ?>

        <!-- Tombol Kembali -->
        <a href="index.php" class="btn back-button">Kembali ke Daftar Kursus</a>
    </div>
</body>
</html>
