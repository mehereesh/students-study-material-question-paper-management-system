<?php
session_start();
if ($_SESSION['role'] !== 'teacher') {
    header("Location: ../index.php");
    exit();
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $year = $_POST['year'];
    $uploaded_by = $_SESSION['user_id'];
    $file_path = 'uploads/' . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
        $sql = "INSERT INTO materials (title, subject, year, file_path, uploaded_by) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $title, $subject, $year, $file_path, $uploaded_by);
        $stmt->execute();
        echo "File uploaded successfully!";
    } else {
        echo "File upload failed.";
    }
    $stmt->close();
    $conn->close();
}
?>
