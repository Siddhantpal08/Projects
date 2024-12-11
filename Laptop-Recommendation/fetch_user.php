<?php
session_start();

$response = [];
if (isset($_SESSION['username'])) {
    $response['username'] = $_SESSION['username'];
} else {
    $response['username'] = 'Guest';
}
echo json_encode($response);
?>
