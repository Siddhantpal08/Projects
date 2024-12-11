<?php
header('Content-Type: application/json');
include 'db_connect.php';

// Get the chosen profession from POST data
$profession = $_POST['profession'] ?? '';

// Ensure variables are set correctly
error_log("Profession: $profession");

// Fetch data from laptops table where category matches the chosen profession
$sql = "SELECT brand, model, specifications, price FROM laptops WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $profession);
$stmt->execute();
$result = $stmt->get_result();

$laptops = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        error_log(print_r($row, true)); // Log each row's data
        $laptops[] = $row;
    }
} else {
    error_log('No laptops found for this profession.');
    $laptops = ['message' => 'No laptops found for this profession.'];
}

$stmt->close();
$conn->close();
echo json_encode($laptops);
?>