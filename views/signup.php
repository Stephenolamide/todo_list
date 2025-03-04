<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="public/signup.css">
</head>
<body>
    <div class="auth-container">
        <h2>Sign Up</h2>
        <form action="../controllers/authController.php" method="POST">
            <div class="input-group">
                <input type="text" name="username" id="username" required placeholder=" ">
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" required placeholder=" ">
                <label for="password">Password</label>
            </div>
            <button type="submit" name="signup" class="btn">Create Account</button>
        </form>
        <p>Already have an account? <a href="../index.php">Login</a></p>
    </div>
</body>
</html>
