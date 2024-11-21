<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require 'db.php'; // Ensure correct path

// Check if user ID is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);  // Bind ID parameter as integer

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No user ID provided.";
}

$conn->close();

// Redirect back to the admin dashboard after deletion
header("Location: ../admin_dashboard.php");
exit();
?>
