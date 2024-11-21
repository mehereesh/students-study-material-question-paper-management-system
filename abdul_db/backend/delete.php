<?php
session_start();
if ($_SESSION['role'] !== 'teacher') {
    header("Location: ../index.php");
    exit();
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Find file path
    $sql = "SELECT file_path FROM materials WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['file_path'];

        // Delete file from directory
        if (unlink($file_path)) {
            // Delete from database
            $delete_sql = "DELETE FROM materials WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("i", $id);
            $delete_stmt->execute();
            echo "File deleted successfully!";
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "File not found.";
    }
    $stmt->close();
    $conn->close();
}
?>
