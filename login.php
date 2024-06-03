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
$user_password = $data['password'];

$sql = "SELECT * FROM users WHERE user_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

$response = ["success" => false];

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($user_password, $row['password'])) {
        $_SESSION['username'] = $user_name;
        $response["success"] = true;
    }
}

echo json_encode($response);

$conn->close();
?>