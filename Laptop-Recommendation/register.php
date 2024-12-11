<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connect.php';

// Retrieve form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Hash the password (ensure to use a secure hashing algorithm)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the user into the database
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registration successful.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
