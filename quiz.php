<?php
// Use the auth guard to protect this page
require_once "includes/auth.php";
require_once "includes/db.php";

// --- Validate Quiz ID ---
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("location: dashboard.php");
    exit;
}

$quiz_id = (int)$_GET['id'];

// --- Fetch Quiz Title ---
$quiz_title = "Quiz";
$sql = "SELECT title FROM quizzes WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $quiz_id);
    if ($stmt->execute()) {
        $stmt->bind_result($title);
        if ($stmt->fetch()) {
            $quiz_title = htmlspecialchars($title);
        } else {
            header("location: dashboard.php");
            exit;
        }
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $quiz_title; ?> - Online Quiz App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php require_once "includes/navbar.php"; ?>

    <div class="quiz-page-container">
        <div id="quiz-container" class="main-container" data-quiz-id="<?php echo $quiz_id; ?>">
            
            <div class="quiz-header">
                <div class="hud">
                    <div class="hud-item">
                        <p class="hud-prefix">Score</p>
                        <h1 class="hud-main-text" id="score-value">0</h1>
                    </div>
                    <div class="hud-item lifelines-container">
                        <button id="lifeline-5050" class="lifeline-btn">
                            50/50
                            <span id="lifeline-5050-counter" class="lifeline-counter">3</span>
                        </button>
                        <button id="lifeline-hint" class="lifeline-btn">
                            Hint
                            <span id="lifeline-hint-counter" class="lifeline-counter">5</span>
                        </button>
                        <button id="lifeline-time" class="lifeline-btn">
                            +15s
                            <span id="lifeline-time-counter" class="lifeline-counter">2</span>
                        </button>
                    </div>
                    <div class="hud-item">
                        <p class="hud-prefix">Time Left</p>
                        <h1 class="hud-main-text" id="timer-value">30:00</h1>
                    </div>
                </div>
                <h2 id="question">Loading Question...</h2>
            </div>

            <div id="hint-box" class="hint-box"></div>

            <div id="options" class="options-container">
                <!-- Options will be dynamically inserted here by quiz.js -->
            </div>

            <div class="progress-container">
                <p id="progress-text">Question 1 / X</p>
                <div id="progress-bar">
                    <div id="progress-bar-full"></div>
                </div>
            </div>
            
            <div class="quiz-actions">
                <button id="next-btn" class="btn" style="display: none;">Next Question</button>
                <button id="quit-btn" class="btn">Quit Quiz</button>
            </div>

        </div>
    </div>

    <div id="quit-modal" class="modal-overlay">
        <div class="modal-content">
            <h3>Are you sure?</h3>
            <p>Are you sure you want to quit the quiz? Your current score will be saved and the attempt will end.</p>
            <div class="modal-actions">
                <button id="modal-confirm-btn" class="btn">Yes, Quit</button>
                <button id="modal-cancel-btn" class="btn">Cancel</button>
            </div>
        </div>
    </div>

    <?php require_once "includes/footer.php"; ?>

    <script src="js/main.js"></script>
    <script src="js/quiz.js"></script>
    <script src="js/navbar.js"></script>
</body>
</html>
