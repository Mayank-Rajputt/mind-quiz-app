<?php

define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'root');

define('DB_PASSWORD', '');

// Database Name 
define('DB_NAME', 'quiz_app_db');


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    
    die("FATAL ERROR: Could not connect to the database. " . $conn->connect_error);
}

if (!$conn->set_charset("utf8mb4")) {
  
    // printf("Error loading character set utf8mb4: %s\n", $conn->error);
}

?>
