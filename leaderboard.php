<?php
// Use the auth guard to protect this page
require_once "includes/auth.php";
require_once "includes/db.php";

$user_name = htmlspecialchars($_SESSION["name"]);

// --- Fetch Leaderboard Data ---
$leaderboard = [];
// UPDATED: Removed u.avatar from the SELECT and GROUP BY clauses
$sql = "SELECT u.name, MAX(r.score) as highScore
        FROM results r
        JOIN users u ON r.user_id = u.id
        GROUP BY u.id, u.name
        ORDER BY highScore DESC
        LIMIT 10";

if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaderboard[] = $row;
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
    <title>Leaderboard - Online Quiz App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php require_once "includes/navbar.php"; ?>

    <div class="page-container">
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Top Players</h1>
                <p>See who's at the top of the leaderboard.</p>
            </div>
        </header>

        <main class="leaderboard-container">
            <?php if (!empty($leaderboard)): ?>
                <ol class="leaderboard-list">
                    <?php foreach ($leaderboard as $index => $player): ?>
                        <li class="leaderboard-item">
                            <div class="player-rank">
                                <span><?php echo $index + 1; ?></span>
                            </div>
                            <!-- REMOVED: The img tag for the avatar is gone -->
                            <div class="player-name">
                                <?php echo htmlspecialchars($player['name']); ?>
                            </div>
                            <div class="player-score">
                                <?php echo $player['highScore']; ?> PTS
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php else: ?>
                <div class="main-container">
                    <div class="message">
                        <p>No scores have been recorded yet. Be the first to take a quiz!</p>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <?php require_once "includes/footer.php"; ?>

    <script src="js/main.js"></script>
    <script src="js/navbar.js"></script>
</body>
</html>
