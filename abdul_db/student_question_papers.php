<?php
session_start();
include 'backend/db.php';

if ($_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit();
}

// Handle search query
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM question_papers WHERE
    (subject_name LIKE '%$search%' OR course LIKE '%$search%' OR year LIKE '%$search%') 
    ORDER BY year DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Question Papers</title>
</head>
<body>
<header>
<header>
    <img src="https://res.cloudinary.com/dpe4zyaxf/image/upload/v1731349424/logo_yudily.png" alt="Logo" class="logo">
    <h1>Question Papers</h1>
</header>
<a href="student_dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
</header>
<main>
    <form method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Search by keyword, subject, course, or year" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>
    <div class="materials-list">
        <?php if ($result->num_rows > 0): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['course']); ?></td>
                            <td><?php echo htmlspecialchars($row['year']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($row['pdf_url']); ?>" target="_blank">View PDF</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No question papers found.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
