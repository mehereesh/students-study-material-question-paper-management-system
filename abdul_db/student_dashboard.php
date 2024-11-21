<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="header-container">
    <img src="https://res.cloudinary.com/dpe4zyaxf/image/upload/v1731349424/logo_yudily.png" alt="Logo" class="logo">
        <h1>Student Dashboard</h1>
        <a href="backend/logout.php" class="logout-button">Logout</a>
    </div>
</header>
<main>
    <h2>Welcome to the Student Dashboard</h2>
    <div class="dashboard-buttons">
        <a href="student_study_materials.php" class="button">View Study Materials</a>
        <a href="student_question_papers.php" class="button">View Question Papers</a>
    </div>
</main>
<footer>
    <p>&copy; 2024 Sathyabama University. All rights reserved.</p>
</footer>
</body>
</html>
