<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: criar_conta.html');
    exit();
}

include 'database.php';

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
    <title>Definições</title>
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
        <h2 style="margin-top: 10%;">Definições</h2>
        <form method="POST" action="user_settings.php">
            <div class="mb-3">
                <label for="username" class="form-label">Novo Nome</label>
                <input type="text" class="form-control" placeholder="Nome" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nova Palavra-Passe</label>
                <input type="password" class="form-control" placeholder="Palavra-Passe" id="password" name="password"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>