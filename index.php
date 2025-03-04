<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: views/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/styles.css">
</head>

<body>
    <div class="auth-container">
        <h2>Login</h2>
        <?php if (isset($_GET['registered'])): ?>
            <p class="success-msg">Registration successful! You can now log in.</p>
        <?php endif; ?>
        <form action="./controllers/authController.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="./views/signup.php">Register</a></p>
    </div>
</body>

</html>
