<?php
/**
 * API Endpoint: Get Questions
 *
 * This script fetches all questions for a specific quiz from the database
 * and returns them as a JSON object. This acts as a mini-API for our frontend.
 *
 * It's protected by our authentication guard to ensure only logged-in users
 * can fetch quiz data.
 *
 * NOW INCLUDES THE 'HINT' DATA.
 */

// Set the content type header to signal that the response is JSON.
header('Content-Type: application/json');

// Include necessary files
require_once "../includes/auth.php"; // Ensures user is logged in
require_once "../includes/db.php";   // Database connection

// --- Input Validation ---
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid or missing quiz ID.']);
    exit;
}

$quiz_id = (int)$_GET['id'];

// --- Fetch Questions from Database ---
$questions = [];

// *** THE ONLY CHANGE IS HERE: We now select the 'hint' column as well. ***
$sql = "SELECT id, question_text, option1, option2, option3, option4, correct_answer, hint FROM questions WHERE quiz_id = ? ORDER BY RAND()";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $quiz_id);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $questions[] = $row;
            }
        }
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to execute statement.']);
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Failed to prepare statement.']);
    $conn->close();
    exit;
}

$conn->close();

// --- Return JSON Response ---
echo json_encode($questions);

?>
