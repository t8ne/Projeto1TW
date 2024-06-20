<?php
include 'database.php';

$data = json_decode(file_get_contents("php://input"), true);
$new_username = $data['username'];

$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_name = ?");
$stmt->bind_param("s", $new_username);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

$response = ['exists' => $count > 0];
echo json_encode($response);
?>