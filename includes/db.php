<?php
/**
 * Database Connection
 *
 * This file establishes a connection to the MySQL database.
 * It uses constants for database credentials for easy configuration.
 * This script will be included in all PHP files that need database access.
 */

// --- DATABASE CREDENTIALS ---
// These are the default credentials for a local WAMP/XAMPP server.
// If your setup is different, change these values accordingly.

// The server where your database is hosted (usually 'localhost' for local development)
define('DB_SERVER', 'localhost');

// Your MySQL database username (default is 'root')
define('DB_USERNAME', 'root');

// Your MySQL database password (default is empty for WAMP/XAMPP)
define('DB_PASSWORD', '');

// The name of the database we created
define('DB_NAME', 'quiz_app_db');


// --- ATTEMPT TO CONNECT TO MYSQL DATABASE ---

// Create a new mysqli object to establish the connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
if ($conn->connect_error) {
    // If the connection fails, stop the script and display an error message.
    // The die() function is used here to halt execution, which is acceptable for a critical error like a failed DB connection.
    die("FATAL ERROR: Could not connect to the database. " . $conn->connect_error);
}

// Optional: Set the character set to utf8mb4 to support a wide range of characters, including emojis.
if (!$conn->set_charset("utf8mb4")) {
    // This is less critical, but good to know if it fails.
    // You could log this error instead of killing the script.
    // For simplicity, we'll keep it straightforward.
    // printf("Error loading character set utf8mb4: %s\n", $conn->error);
}

?>
