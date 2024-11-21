<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require 'backend/db.php';

// Search functionality
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM users WHERE username LIKE ? OR registration_number LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all users from the database if no search term is provided
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="header-container">
        <h1>Admin Dashboard</h1>
        <a href="backend/logout.php" class="logout-button">Logout</a>
    </div>
</header>
<main>
    <h2>Welcome, Admin!</h2>

    <!-- Create New User Section -->
    <h3>Create New User</h3>
    <form action="create_user.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="registration_number">Registration Number:</label>
        <input type="text" id="registration_number" name="registration_number" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>

        <button type="submit" class="button">Create User</button>
    </form>

    <!-- Search User Section -->
    <h3>Search Users</h3>
    <form method="POST">
        <input type="text" name="search" placeholder="Search by username or registration number" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="button">Search</button>
    </form>

    <!-- Display all users or search results -->
    <h3>All Users</h3>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Registration Number</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['registration_number'] . "</td>
                    <td>" . $row['role'] . "</td>
                    <td><a href='backend/delete_user.php?id=" . $row['id'] . "' class='button'>Delete</a></td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No users found.";
    }

    $conn->close();
    ?>
</main>

<footer>
    <p>&copy; 2024 Your College Name. All rights reserved.</p>
</footer>
</body>
</html>
