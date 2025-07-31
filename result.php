<?php
// Use the auth guard to protect this page
require_once "includes/auth.php";
require_once "includes/db.php";

// --- INITIALIZATION ---
$score = $total_questions = $quiz_id = 0;
$user_id = $_SESSION["id"];

// --- PROCESS AND SAVE RESULT ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = isset($_POST['score']) ? (int)$_POST['score'] : 0;
    $total_questions = isset($_POST['total_questions']) ? (int)$_POST['total_questions'] : 0;
    $quiz_id = isset($_POST['quiz_id']) ? (int)$_POST['quiz_id'] : 0;

    if ($quiz_id > 0 && $user_id > 0 && $total_questions > 0) {
        $sql = "INSERT INTO results (user_id, quiz_id, score, total_questions) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iiii", $user_id, $quiz_id, $score, $total_questions);
            $stmt->execute();
            $stmt->close();
        }
    }
    $conn->close();
} else {
    header("location: dashboard.php");
    exit;
}

// --- CALCULATE PERCENTAGE AND GET FEEDBACK ---
$percentage = ($total_questions > 0) ? round(($score / $total_questions) * 100) : 0;
$feedback_message = "";
$feedback_class = "";

if ($percentage >= 90) {
    $feedback_message = "Outstanding! You're a true genius!";
    $feedback_class = "success";
} elseif ($percentage >= 75) {
    $feedback_message = "Excellent Work! You really know your stuff.";
    $feedback_class = "success";
} elseif ($percentage >= 50) {
    $feedback_message = "Good Job! A solid performance.";
    $feedback_class = "warning";
} else {
    $feedback_message = "Good try! Keep practicing to improve.";
    $feedback_class = "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result - Online Quiz App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php require_once "includes/navbar.php"; ?>

    <div class="page-container">
        <div class="main-container result-container">
            <h2>Quiz Completed!</h2>
            
            <div class="result-score-circle <?php echo $feedback_class; ?>">
                <span class="result-percentage"><?php echo $percentage; ?>%</span>
                <span class="result-score-text">Your Score</span>
            </div>

            <p class="final-score-display">You answered <?php echo $score; ?> out of <?php echo $total_questions; ?> questions correctly.</p>

            <div class="message <?php echo $feedback_class; ?>">
                <?php echo $feedback_message; ?>
            </div>

            <div class="result-actions">
                <a href="quiz.php?id=<?php echo $quiz_id; ?>" class="btn">Play Again</a>
                <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <?php require_once "includes/footer.php"; ?>

    <script src="js/main.js"></script>
    <script src="js/navbar.js"></script>
</body>
</html>
