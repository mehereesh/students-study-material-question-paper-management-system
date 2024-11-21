<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registration_number = $_POST['registration_number'];
    $password = $_POST['password'];

    // Check if fields are empty
    if (empty($registration_number) || empty($password)) {
        die("Please fill out all required fields.");
    }

    // Query to check the user
    $sql = "SELECT * FROM users WHERE registration_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $registration_number);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Compare the plaintext password
        if ($password === $user['password']) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: ../admin_dashboard.php");
            } elseif ($user['role'] === 'teacher') {
                header("Location: ../teacher_dashboard.php");
            } elseif ($user['role'] === 'student') {
                header("Location: ../student_dashboard.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid registration number.";
    }

    $stmt->close();
    $conn->close();
}
?>
