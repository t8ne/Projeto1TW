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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="images/logo2.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            /* Define a fonte do texto */
            margin: 0;
            /* Remove as margens padrão do corpo da página */
            background-image: url("images/opium.png");
            /* Define a imagem de fundo */
            background-size: cover;
            /* Garante que a imagem de fundo cubra toda a área disponível */
            color: #ffffff;
            /* Define a cor do texto como branco */
        }

        .navbar-brand img {
            max-width: 50px;
            /* Tornar o logotipo um pouco menor */
            height: auto;
        }

        .navbar {
            background-color: #000 !important;
            /* Cor de fundo da barra de navegação preta */
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .create-account-text {
            margin-right: 10px;
            /* Espaçamento à direita */
            color: #000;
            /* Cor do texto preto */
            background-color: #fff;
            /* Cor de fundo branca */
            padding: 5px 10px;
            /* Adicionar preenchimento ao redor do texto */
            border-radius: 5px;
            /* Cantos arredondados */
            text-decoration: none;
            /* Remover sublinhado */
            font-family: "Old English Text MT", serif;
            /* Definir a fonte Old English */
            font-weight: bold;
            /* Tornar o texto em negrito */
        }

        .create-account-text:hover {
            color: #fff;
            /* Mudar a cor do texto para branco ao passar o mouse */
            background-color: #000;
            /* Mudar a cor de fundo para preto ao passar o mouse */
        }

        .about-text {
            margin-right: 20px;
            /* Espaçamento à direita */
            color: #fff;
            /* Cor do texto branco */
            font-family: "Old English Text MT", serif;
            /* Definir a fonte Old English */
            text-decoration: none;
            /* Remover sublinhado */
        }

        .about-text:hover {
            text-decoration: underline;
            /* Adicionar sublinhado ao passar o mouse */
        }

        .content {
            text-align: center;
            /* Centraliza todo o conteúdo */
            margin: 0 auto;
            /* Centraliza o conteúdo horizontalmente */
            max-width: 800px;
            /* Define a largura máxima do conteúdo */
        }

        h1 {
            font-family: "Old English Text MT", serif;
            /* Define a fonte Old English para o título */
            font-size: 36px;
            /* Define o tamanho do título */
            margin-top: 140px;
            /* Define a margem superior do título */
            margin-bottom: 280px;
            /* Define a margem inferior do título */
            color: #ffffff;
            /* Define a cor do texto como branco */
            font-size: 80px;
        }

        p {
            font-weight: bold;
            /* Define o texto em negrito */
            color: #ffffff;
            /* Define a cor do texto como branco */
            margin-bottom: 20px;
            /* Define a margem inferior do texto */
            font-size: 16px;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Dashboard</h2>
        <table class="table">
            <thead>
                <tr style="color: white;">
                    <th>ID de Utilizador</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr style="color: white;">
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
                                <input type="text" name="username" placeholder="Novo Nome" required>
                                <input type="password" name="password" placeholder="Nova Palavra-Passe" required>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Criar Novo Utilizador</h3>
        <form method="POST">
            <input type="hidden" name="action" value="create">
            <input type="text" name="username" placeholder="Nome" required>
            <input type="password" name="password" placeholder="Palavra-Passe" required>
            <button type="submit" class="btn btn-success">Criar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>