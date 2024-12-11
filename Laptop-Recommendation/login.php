<?php
include 'db_connect.php';

session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

$response = [];
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $response['success'] = true;
    $response['message'] = 'Login successful';
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid credentials';
}
$conn->close();
echo json_encode($response);
?>
