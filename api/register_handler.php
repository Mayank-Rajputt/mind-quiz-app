<?php
/**
 * API Endpoint: Register Handler
 *
 * This script handles the user registration process via an AJAX request.
 * It validates the input, creates the new user, and returns a JSON response.
 */

// Set the content type to JSON for the response.
header('Content-Type: application/json');

// Start the session (though not strictly needed for registration, it's good practice).
session_start();

// Include the database connection. The path is relative to this file's location.
require_once "../includes/db.php";

// --- INITIALIZATION ---
$errors = [];
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// Check if the request method is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data.
    $input = json_decode(file_get_contents('php://input'), true);

    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';

    // --- VALIDATION ---

    // 1. Validate Name
    if (empty(trim($name))) {
        $errors['name'] = "Please enter your full name.";
    }

    // 2. Validate Email
    if (empty(trim($email))) {
        $errors['email'] = "Please enter your email address.";
    } elseif (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = trim($email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $errors['email'] = "This email address is already taken.";
                }
            } else {
                $errors['general'] = "Database error. Please try again.";
            }
            $stmt->close();
        }
    }

    // 3. Validate Password
    if (empty(trim($password))) {
        $errors['password'] = "Please enter a password.";
    } elseif (strlen(trim($password)) < 6) {
        $errors['password'] = "Password must have at least 6 characters.";
    }

    // --- PROCESS REGISTRATION ---

    if (empty($errors)) {
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $param_name, $param_email, $param_password);
            
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Registration successful! You can now log in.";
                $response['success'] = true;
                $response['message'] = "Registration successful!";
            } else {
                $response['message'] = "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    } else {
        $response['message'] = "Please correct the errors below.";
        $response['errors'] = $errors;
    }

} else {
    // If not a POST request, return an error.
    http_response_code(405); // Method Not Allowed
    $response['message'] = "Invalid request method.";
}

$conn->close();

// Echo the JSON response.
echo json_encode($response);
?>
