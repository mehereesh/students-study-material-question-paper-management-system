<?php
session_start();
include 'backend/db.php';

// Check if teacher is logged in
if ($_SESSION['role'] !== 'teacher') {
    header("Location: index.php");
    exit();
}

// Handle form submission for adding URLs for materials and question papers
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle study material URL submission
    if (isset($_POST['material_url'])) {
        $material_url = $_POST['material_url'];
        $subject = $_POST['subject'];
        $course = $_POST['course'];
        $year = $_POST['year'];

        // Insert study material URL into database
        $sql = "INSERT INTO materials (subject_name, course, year, pdf_url) 
                VALUES ('" . $subject . "', '" . $course . "', '" . $year . "', '" . $material_url . "')";
        $conn->query($sql);
    }

    // Handle question paper URL submission
    if (isset($_POST['question_paper_url'])) {
        $question_paper_url = $_POST['question_paper_url'];
        $subject = $_POST['subject'];
        $course = $_POST['course'];
        $year = $_POST['year'];

        // Insert question paper URL into database
        $sql = "INSERT INTO question_papers (subject_name, course, year, pdf_url) 
                VALUES ('" . $subject . "', '" . $course . "', '" . $year . "', '" . $question_paper_url . "')";
        $conn->query($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Teacher Dashboard</title>
</head>
<body>
<header>
    <div class="header-container">
        <a href="index.php">
            <img src="https://res.cloudinary.com/dpe4zyaxf/image/upload/v1731349424/logo_yudily.png" alt="Logo" class="logo">
        </a>
        <h1>Teacher Dashboard</h1>
        <a href="backend/logout.php" class="logout-button">Logout</a>
    </div>
</header>
<main>
<section class="note-section">
    <p class="note">
         <strong>Note:</strong> Before uploading the PDF URL, please upload your PDF file to the following Drive under your registration-numbered folder. Tap "Share," copy the link, and paste it into the PDF URL field below.
    </p>
    <div class="note-button-container">
        <a href="https://drive.google.com/drive/folders/1ZTT_tGT-WrLq_88seJ53scsG2gbnnUWY?usp=drive_link" 
           target="_blank" class="note-button">
           Open Drive
        </a>
    </div>
</section>


    <section class="upload-section">
        <h2>Upload Study Material</h2>
        <form action="teacher_dashboard.php" method="POST" class="upload-form">
            <input type="text" name="subject" placeholder="Subject" required>
            <input type="text" name="course" placeholder="Course" required>
            <input type="number" name="year" placeholder="Year" required>
            <input type="url" name="material_url" placeholder="Enter PDF URL" required>
            <button type="submit" class="submit-button">Upload Material</button>
        </form>
    </section>

    <section class="upload-section">
        <h2>Upload Question Paper</h2>
        <form action="teacher_dashboard.php" method="POST" class="upload-form">
            <input type="text" name="subject" placeholder="Subject" required>
            <input type="text" name="course" placeholder="Course" required>
            <input type="number" name="year" placeholder="Year" required>
            <input type="url" name="question_paper_url" placeholder="Enter PDF URL" required>
            <button type="submit" class="submit-button">Upload Question Paper</button>
        </form>
    </section>
</main>

</body>
</html>
