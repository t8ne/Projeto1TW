<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: criar_conta.html');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto1tw";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET user_name = ?, password = ? WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $new_username, $new_password, $user_name);

    if ($stmt->execute()) {
        $_SESSION['username'] = $new_username;
        echo "User information updated successfully.";
    } else {
        echo "Error updating user information.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>User Settings</h2>
        <form method="POST" action="user_settings.php">
            <div class="mb-3">
                <label for="username" class="form-label">New Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>