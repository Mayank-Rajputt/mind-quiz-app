<?php
// Use the auth guard to protect this page
require_once "includes/auth.php";
// Include the database connection
require_once "includes/db.php";

// Get user's name from the session for the navbar and welcome message
$user_name = htmlspecialchars($_SESSION["name"]);

// --- Fetch Quizzes from Database ---
$quizzes = [];
$sql = "SELECT id, title, description FROM quizzes ORDER BY title ASC";
if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quizzes[] = $row;
        }
    }
    $result->free();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Online Quiz App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php require_once "includes/navbar.php"; ?>

    <div class="page-container">
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Welcome, <?php echo $user_name; ?>!</h1>
                <p>Select a quiz below to test your knowledge.</p>
            </div>
        </header>

        <main class="quiz-list">
            <?php if (!empty($quizzes)): ?>
                <?php foreach ($quizzes as $quiz): ?>
                    <div class="quiz-card">
                        <div class="card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-patch-question-fill" viewBox="0 0 16 16">
                                <path d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.638.622a2.89 2.89 0 0 1 0 4.134l-.638.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.638a2.89 2.89 0 0 1-4.134 0l-.622-.638-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.638-.622a2.89 2.89 0 0 1 0-4.134l.638-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.638zM6.61 4.545a1.125 1.125 0 1 0 2.25 0 1.125 1.125 0 0 0-2.25 0zM8 12.5a1 1 0 0 0 1-1h-2a1 1 0 0 0 1 1zm.5-2.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                            </svg>
                        </div>
                        <h3 class="card-title"><?php echo htmlspecialchars($quiz['title']); ?></h3>
                        <p class="card-description"><?php echo htmlspecialchars($quiz['description']); ?></p>
                        <a href="quiz.php?id=<?php echo $quiz['id']; ?>" class="btn btn-secondary">Start Quiz</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="message warning">
                    <p>No quizzes are available at the moment. Please check back later.</p>
                </div>
            <?php endif; ?>
        </main>

        <div class="dashboard-logout-container">
            <!-- Changed to an ID for easier JS targeting -->
            <a href="logout.php" id="dashboard-logout-btn" class="btn logout-btn">Logout</a>
        </div>

    </div>

    <!-- NEW: Logout Confirmation Modal -->
    <div id="logout-modal" class="modal-overlay">
        <div class="modal-content">
            <h3>Confirm Logout</h3>
            <p>Are you sure you want to log out?</p>
            <div class="modal-actions">
                <a href="logout.php" id="modal-logout-confirm" class="btn">Yes, Logout</a>
                <button id="modal-logout-cancel" class="btn">Cancel</button>
            </div>
        </div>
    </div>
    
    <?php require_once "includes/footer.php"; ?>

    <script src="js/main.js"></script>
    <script src="js/navbar.js"></script> 
</body>
</html>
