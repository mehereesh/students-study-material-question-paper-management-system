<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $registration_number = $_POST['registration_number'];
    $password = $_POST['password'];  // Plaintext password, can hash if necessary
    $role = $_POST['role'];

    // Validate input data (e.g., check if all fields are filled)
    if (empty($username) || empty($registration_number) || empty($password) || empty($role)) {
        echo "All fields are required!";
        exit();
    }

    // Check if the registration number already exists in the database
    $sql = "SELECT * FROM users WHERE registration_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $registration_number);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "Registration number already exists!";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, registration_number, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $registration_number, $password, $role);
        
        if ($stmt->execute()) {
            echo "User created successfully!";
        } else {
            echo "Error creating user: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
