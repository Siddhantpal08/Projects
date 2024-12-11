<?php
header('Content-Type: application/json');
include 'db_connect.php';

$ram = $_POST['ram'] ?? '';
$storage = $_POST['storage'] ?? '';

// Ensure variables are set correctly
error_log("RAM: $ram, Storage: $storage");

$sql = "SELECT * FROM laptops WHERE specifications LIKE ? AND specifications LIKE ?";
$stmt = $conn->prepare($sql);
$ram = "%" . $ram . "%";
$storage = "%" . $storage . "%";
$stmt->bind_param("ss", $ram, $storage);
$stmt->execute();
$result = $stmt->get_result();

$laptops = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $laptops[] = $row;
    }
} else {
    $laptops = ['message' => 'No laptops found for these specifications.'];
}

$stmt->close();
$conn->close();
echo json_encode($laptops);
?>
