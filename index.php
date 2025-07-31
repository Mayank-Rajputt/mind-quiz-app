<?php
/**
 * Application Entry Point
 *
 * This script acts as a router. It checks if the user is already logged in by
 * looking for a session variable.
 *
 * - If the user is logged in, it redirects them to the main dashboard.
 * - If the user is not logged in, it redirects them to the login page.
 *
 * This prevents logged-in users from having to see the login page again
 * and ensures new users start at the correct location.
 */

// Start the session to access session variables.
// This must be called before any output is sent to the browser.
session_start();

// Check if the 'loggedin' session variable exists and is set to true.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // User is logged in, redirect to the dashboard.
    header("location: dashboard.php");
    exit; // It's crucial to exit after a header redirect to prevent further script execution.
} else {
    // User is not logged in, redirect to the login page.
    header("location: login.php");
    exit; // Crucial exit.
}

?>
