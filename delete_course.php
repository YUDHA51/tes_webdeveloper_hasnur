<?php
include 'db/connection.php';

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $course_title = isset($_GET['title']) ? $_GET['title'] : '';

    // Query to delete course
    $sql = "DELETE FROM courses WHERE id = '$course_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Kursus berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Redirect to the list of courses
    header('Location: index.php');
    exit;
} else {
    echo "ID kursus tidak ditemukan.";
    exit;
}
