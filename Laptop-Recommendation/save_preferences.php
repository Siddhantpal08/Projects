<?php
include 'db_connect.php';

session_start();
$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session after login

$profession = $_POST['profession'] ?? '';
$budget = $_POST['budget'] ?? '';
$specifications = $_POST['specifications'] ?? '';

$sql = "INSERT INTO preferences (user_id, profession, budget, specifications) VALUES ('$user_id', '$profession', '$budget', '$specifications')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Preferences saved successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error saving preferences']);
}
$conn->close();
?>
