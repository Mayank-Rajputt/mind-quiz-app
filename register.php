<?php
// Start the session to check login status.
session_start();

// If the user is already logged in, redirect them to the dashboard.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mind Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<!-- Add the special class to the body for centering -->
<body class="auth-page">

    <div class="theme-switch-wrapper" style="position: fixed; top: 20px; right: 20px;">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
        </label>
    </div>

    <!-- This new wrapper will center the title and the form box -->
    <div class="auth-page-wrapper">
        <h1 class="app-title">MIND QUIZ</h1>

        <div class="main-container">
            <h2>Create Account</h2>
            <p>Join us and start your quiz journey!</p>

            <form id="registerForm" data-endpoint="api/register_handler.php" novalidate>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                    <div class="error-text"></div>
                </div>    
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 6 characters" required>
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Create Account</button>
                </div>
                <p class="form-link">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="js/auth.js"></script>
</body>
</html>
