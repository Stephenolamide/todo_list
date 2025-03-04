
<?php
session_start();
require '../config/database.php';

// Register User
if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

    // Check if username exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "Username already taken!";
        exit();
    }

    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        header("Location: ../index.php?registered=true"); // Redirect to login
    } else {
        echo "Registration failed!";
    }
}

// Login User
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Fetch user data
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../views/dashboard.php"); // Redirect to dashboard
    } else {
        echo "Invalid login credentials!";
    }
}

// Logout User
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
