<?php
// Use the auth guard to protect this page
require_once "includes/auth.php";
// We don't need a database connection for this placeholder page yet.

$user_name = htmlspecialchars($_SESSION["name"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Challenge - Online Quiz App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php require_once "includes/navbar.php"; ?>

    <div class="page-container">
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Daily Challenge</h1>
                <p>A new challenge, every single day!</p>
            </div>
        </header>

        <main>
            <div class="main-container" style="text-align: center;">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-calendar2-event" viewBox="0 0 16 16">
                        <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                    </svg>
                </div>
                <h2 style="margin-top: 1rem;">Coming Soon!</h2>
                <p>This exciting feature is under construction. Check back soon for a new, unique quiz challenge every day!</p>
                <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </main>
    </div>

    <?php require_once "includes/footer.php"; ?>

    <script src="js/main.js"></script>
    <script src="js/navbar.js"></script>
</body>
</html>
