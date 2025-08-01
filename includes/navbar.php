<?php

$current_page = basename($_SERVER['SCRIPT_NAME']);

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) :
?>
<nav class="app-navbar">
    <div class="navbar-left">
        <a href="dashboard.php" class="navbar-logo">
            <img src="logo.png" alt="Logo" onerror="this.style.display='none'; this.onerror=null;">
        </a>
        <div class="navbar-links">
            <?php if (in_array($current_page, ['dashboard.php', 'history.php', 'leaderboard.php', 'profile.php'])) : ?>
                <a href="dashboard.php" class="nav-item <?php if($current_page === 'dashboard.php') echo 'active'; ?>">Dashboard</a>
                <a href="history.php" class="nav-item <?php if($current_page === 'history.php') echo 'active'; ?>">History</a>
                <a href="leaderboard.php" class="nav-item <?php if($current_page === 'leaderboard.php') echo 'active'; ?>">Leaderboard</a>
            <?php elseif ($current_page === 'quiz.php') : ?>
                <div class="quiz-live-stats">
                    <div class="stat-item"><span>Score:</span> <span id="navbar-score">0</span></div>
                    <div class="stat-item progress-stat"><span>Progress:</span> <div class="navbar-progress-bar"><div id="navbar-progress" style="width: 0%;"></div></div></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="navbar-right">
        <?php if ($current_page !== 'quiz.php') : ?>
        <a href="daily_challenge.php" class="daily-challenge-btn"><span>✨ Daily Challenge</span></a>
        <?php endif; ?>
        
        <div class="theme-switch-wrapper">
            <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="checkbox" />
                <div class="slider round"></div>
            </label>
        </div>

        <button id="mobile-menu-btn" class="mobile-menu-btn"><span></span><span></span><span></span></button>
    </div>
</nav>
<div id="mobile-menu" class="mobile-menu"></div>
<?php endif; ?>
