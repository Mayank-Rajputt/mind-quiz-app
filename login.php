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
    <title>Login - Mind Quiz</title>
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
            <h2>Welcome Back!</h2>
            <p>Login to continue your quiz journey.</p>
            
            <?php 
            if(isset($_SESSION['success_message'])){
                echo '<div class="message success">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }
            ?>

            <form id="loginForm" data-endpoint="api/login_handler.php" novalidate>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Your email address" required>
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Your password" required>
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Login</button>
                </div>
                <p class="form-link">Don't have an account? <a href="register.php">Register now</a></p>
            </form>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="js/auth.js"></script>
</body>
</html>
