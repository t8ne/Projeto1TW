<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    header('Location: criar_conta.html');
    exit();
}

include 'database.php';

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
        $new_password = $_POST['password'];
        $sql = "UPDATE users SET user_name = ?, password = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_username, $new_password, $user_id);
        $stmt->execute();
    } elseif ($action == 'create') {
        $new_username = $_POST['username'];
        $new_password = $_POST['password'];
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="images/logo2.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url("images/opium.png");
            background-size: cover;
            color: #ffffff;
        }

        .navbar {
            background-color: #000 !important;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 999;
        }

        .navbar-brand img {
            max-width: 50px;
            height: auto;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-family: "Old English Text MT", serif;
        }

        .navbar-nav .nav-link:hover {
            color: #aaa !important;
        }

        .container-custom {
            background-color: rgba(128, 128, 128, 0.8);
            padding: 20px;
            border-radius: 15px;
            margin-top: 150px;
            text-align: center;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 15px;
            border: 1px solid #444;
        }

        table th {
            background-color: #444;
        }

        table td {
            background-color: #333;
        }

        .btn {
            margin: 5px;
        }

        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
        }

        .btn-primary {
            background-color: #0275d8;
            border-color: #025aa5;
        }

        .btn-success {
            background-color: #5cb85c;
            border-color: #4cae4c;
        }

        .form-inline input {
            margin: 5px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-inline .btn {
            padding: 10px 20px;
        }

        h2,
        h3 {
            font-family: "Old English Text MT", serif;
        }

        .logo img {
            max-width: 100px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container container-custom">
        <h2>Dashboard</h2>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID de Utilizador</th>
                    <th>Nome</th>
                    <th>Ações</th>
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
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                <input type="hidden" name="action" value="edit">
                                <input type="text" name="username" placeholder="Novo Nome"
                                    class="form-control d-inline w-auto" required>
                                <input type="password" name="password" placeholder="Nova Palavra-Passe"
                                    class="form-control d-inline w-auto" required>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Criar Novo Utilizador</h3>
        <form method="POST" class="form-inline">
            <input type="hidden" name="action" value="create">
            <input type="text" name="username" placeholder="Nome" class="form-control" required>
            <input type="password" name="password" placeholder="Palavra-Passe" class="form-control" required>
            <button type="submit" class="btn btn-success">Criar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>