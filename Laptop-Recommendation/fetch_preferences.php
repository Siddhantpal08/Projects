<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connect.php';

// Start session to retrieve the user_id
session_start(); $_SESSION['user_id'] = 1;
// Fetch preferences for the logged-in user
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id == 0) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT profession, budget, specifications FROM preferences WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$preferences = [];
while ($row = $result->fetch_assoc()) {
    $preferences[] = $row;
}

echo json_encode($preferences);

$stmt->close();
$conn->close();
?>
