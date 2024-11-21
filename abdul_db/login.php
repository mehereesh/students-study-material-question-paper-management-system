<?php
$role = $_GET['role'] ?? 'student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="https://res.cloudinary.com/dpe4zyaxf/image/upload/v1731349424/logo_yudily.png" alt="Logo" class="logo">
    </header>
    <div class="login-form">
        <h2><?php echo ucfirst($role); ?> Login</h2>
        <form action="backend/auth.php" method="POST">
            <input type="hidden" name="role" value="<?php echo $role; ?>">
            <input type="text" name="registration_number" placeholder="Registration Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>