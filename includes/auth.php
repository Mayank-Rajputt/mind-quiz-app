<?php
/**
 * Authentication Guard
 *
 * This script serves as a security guard for protected pages.
 * It must be included at the very top of any PHP file that requires a user to be logged in.
 *
 * How it works:
 * 1. It starts the session to access session data.
 * 2. It checks if the `$_SESSION["loggedin"]` variable is set and if its value is `true`.
 * 3. If the user is NOT logged in (either the variable doesn't exist or is not true),
 * it immediately redirects them to the login page (`login.php`) and stops script execution.
 *
 * This ensures that no part of the protected page's content is ever rendered or accessible
 * to an unauthorized user.
 */

// Start the session to make session variables available.
session_start();

// Check if the user is not logged in.
// The condition `!isset($_SESSION["loggedin"])` checks if the variable has not been set.
// The condition `$_SESSION["loggedin"] !== true` checks if the variable is not explicitly true.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // If either condition is met, the user is not authenticated.
    // Redirect them to the login page.
    header("location: login.php");
    // Terminate the script immediately to prevent any further code on the protected page from running.
    exit;
}
?>
