<?php
/**
 * Logout Script
 *
 * This script handles the user logout process.
 *
 * How it works:
 * 1. It starts the session to gain access to the session data.
 * 2. It unsets all of the session variables using `$_SESSION = array()`.
 * This is a robust way to clear all data associated with the current session.
 * 3. It destroys the session itself using `session_destroy()`. This removes the session
 * data from the server.
 * 4. Finally, it redirects the user back to the login page.
 *
 * This ensures a clean and secure logout, preventing any user data from
 * persisting after they have chosen to log out.
 */

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>
