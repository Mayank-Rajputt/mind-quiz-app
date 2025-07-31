<?php
// Use the auth guard to protect this page
require_once "includes/auth.php";
require_once "includes/db.php";

$user_id = $_SESSION["id"];
$user_name = htmlspecialchars($_SESSION["name"]);

// --- Fetch User's Quiz History ---
$history = [];
$sql = "SELECT q.title, r.score, r.total_questions, r.submitted_at 
        FROM results r 
        JOIN quizzes q ON r.quiz_id = q.id 
        WHERE r.user_id = ? 
        ORDER BY r.submitted_at DESC";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $history[] = $row;
            }
        }
        $result->free();
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
    <title>Quiz History - Online Quiz App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php require_once "includes/navbar.php"; ?>

    <div class="page-container">
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Quiz History</h1>
                <p>Review your past quiz attempts, <?php echo $user_name; ?>.</p>
            </div>
        </header>

        <main class="history-container">
            <div class="main-container">
                <?php if (!empty($history)): ?>
                    <div class="table-wrapper">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Quiz Title</th>
                                    <th>Score</th>
                                    <th>Percentage</th>
                                    <th>Date Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $row): ?>
                                    <tr>
                                        <td data-label="Quiz Title"><?php echo htmlspecialchars($row['title']); ?></td>
                                        <td data-label="Score"><?php echo $row['score']; ?> / <?php echo $row['total_questions']; ?></td>
                                        <td data-label="Percentage">
                                            <?php 
                                            $percentage = ($row['total_questions'] > 0) ? round(($row['score'] / $row['total_questions']) * 100) : 0;
                                            echo $percentage . '%';
                                            ?>
                                        </td>
                                        <td data-label="Date Taken">
                                            <?php 
                                            $date = new DateTime($row['submitted_at']);
                                            echo $date->format('F j, Y, g:i a');
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="message">
                        <p>You haven't completed any quizzes yet. Head back to the <a href="dashboard.php">dashboard</a> to start one!</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <?php require_once "includes/footer.php"; ?>

    <script src="js/main.js"></script>
    <script src="js/navbar.js"></script>
</body>
</html>
