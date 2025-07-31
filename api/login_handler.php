<?php
/**
 * API Endpoint: Login Handler
 *
 * This script handles the user login process via an AJAX request.
 * It validates credentials, creates a session, and returns a JSON response.
 */

header('Content-Type: application/json');
session_start();

require_once "../includes/db.php";

// --- INITIALIZATION ---
$errors = [];
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);

    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';

    // --- VALIDATION ---

    if (empty(trim($email))) {
        $errors['email'] = "Please enter your email.";
    }
    if (empty(trim($password))) {
        $errors['password'] = "Please enter your password.";
    }

    // --- PROCESS LOGIN ---

    if (empty($errors)) {
        $sql = "SELECT id, name, email, password FROM users WHERE email = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $db_email, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            // Regenerate session ID for security
                            session_regenerate_id(true);
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            
                            $response['success'] = true;
                            $response['message'] = "Login successful! Redirecting...";
                        } else {
                            $response['message'] = "Invalid email or password.";
                        }
                    }
                } else {
                    $response['message'] = "Invalid email or password.";
                }
            } else {
                $response['message'] = "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    } else {
        $response['message'] = "Please correct the errors below.";
        $response['errors'] = $errors;
    }
} else {
    http_response_code(405); // Method Not Allowed
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>
