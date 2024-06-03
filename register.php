<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto1tw";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$user_name = $data['username'];
$user_password = password_hash($data['password'], PASSWORD_DEFAULT);

// Ensure user_id is unique
$user_id = rand(1, 1000000);
while ($conn->query("SELECT * FROM users WHERE user_id = $user_id")->num_rows > 0) {
    $user_id = rand(1, 1000000);
}

$sql = "INSERT INTO users (user_id, user_name, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $user_name, $user_password);

$response = ["success" => false];

if ($stmt->execute()) {
    $_SESSION['username'] = $user_name;
    $response["success"] = true;
}

echo json_encode($response);

$conn->close();
?>