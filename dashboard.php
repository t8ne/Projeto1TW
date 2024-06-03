<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $user_id = $_POST['user_id'];

    if ($action == 'delete') {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    } elseif ($action == 'edit') {
        $new_username = $_POST['username'];
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET user_name = ?, password = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_username, $new_password, $user_id);
        $stmt->execute();
    } elseif ($action == 'create') {
        $new_username = $_POST['username'];
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_id = rand(1, 1000000);
        while ($conn->query("SELECT * FROM users WHERE user_id = $user_id")->num_rows > 0) {
            $user_id = rand(1, 1000000);
        }
        $sql = "INSERT INTO users (user_id, user_name, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $new_username, $new_password);
        $stmt->execute();
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Admin Dashboard</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['user_name']; ?></td>
                        <td>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                <input type="hidden" name="action" value="edit">
                                <input type="text" name="username" placeholder="New Username" required>
                                <input type="password" name="password" placeholder="New Password" required>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Create New User</h3>
        <form method="POST">
            <input type="hidden" name="action" value="create">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
</body>

</html>