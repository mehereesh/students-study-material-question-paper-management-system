<?php
// Database connection configuration
$servername = "localhost";  // Your database server
$username = "root";         // Your database username
$password = "";             // Your database password (for local XAMPP default is empty)
$dbname = "abdul_db";       // Your database name (replace with your actual database name)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
