<?php
include 'db_connect.php';

$budget = $_POST['budget'] ?? '';
$brand = $_POST['brand'] ?? '';

$sql = "SELECT * FROM laptops WHERE price <= ?";
if (!empty($brand)) {
    $sql .= " AND brand LIKE ?";
}

$stmt = $conn->prepare($sql);
if (!empty($brand)) {
    $brand = "%" . $brand . "%"; // To use wildcard search with LIKE
    $stmt->bind_param("is", $budget, $brand);
} else {
    $stmt->bind_param("i", $budget);
}
$stmt->execute();
$result = $stmt->get_result();

$laptops = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $laptops[] = $row;
    }
} else {
    $laptops = ['message' => 'No laptops found for this budget.'];
}

$stmt->close();
$conn->close();
echo json_encode($laptops);
?>
