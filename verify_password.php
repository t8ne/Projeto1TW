<?php
session_start();
include 'database.php';

$data = json_decode(file_get_contents("php://input"), true);
$current_password = $data['password'];
$user_name = $_SESSION['username'];

$stmt = $conn->prepare("SELECT password FROM users WHERE user_name = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$stmt->bind_result($stored_password);
$stmt->fetch();
$stmt->close();

$response = ['success' => false];

if ($current_password === $stored_password) {
    $response['success'] = true;
}

echo json_encode($response);
?>