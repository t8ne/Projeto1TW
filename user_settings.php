<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: criar_conta.html');
    exit();
}

include 'database.php';

$user_name = $_SESSION['username'];
$stmt = $conn->prepare("SELECT password FROM users WHERE user_name = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$stmt->bind_result($hashed_password);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new_username'])) {
        $new_username = $_POST['new_username'];
        $current_password = $_POST['current_password'];

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $new_username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($new_username == $user_name) {
            echo "<script>showPopup('Nome de utilizador já usado por si.');</script>";
        } elseif ($count > 0) {
            echo "<script>showPopup('Nome de utilizador em uso.');</script>";
        } elseif (password_verify($current_password, $hashed_password)) {
            $stmt = $conn->prepare("UPDATE users SET user_name = ? WHERE user_name = ?");
            $stmt->bind_param("ss", $new_username, $user_name);
            if ($stmt->execute()) {
                $_SESSION['username'] = $new_username;
                echo "<script>alert('User information updated successfully.');</script>";
            } else {
                echo "<script>alert('Error updating user information.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Incorrect password.');</script>";
        }
    }

    if (isset($_POST['new_password'])) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $current_password = $_POST['current_password'];

        if (password_verify($current_password, $hashed_password)) {
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_name = ?");
            $stmt->bind_param("ss", $new_password, $user_name);
            if ($stmt->execute()) {
                echo "<script>alert('Password updated successfully.');</script>";
            } else {
                echo "<script>alert('Error updating password.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Incorrect password.');</script>";
        }
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
            margin: 0;
            background-image: url("images/opium.png");
            background-size: cover;
            color: #ffffff;
        }

        .navbar-brand img {
            max-width: 50px;
            height: auto;
        }

        .navbar {
            background-color: #000 !important;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            margin-top: -150px
        }

        .create-account-text {
            margin-right: 10px;
            color: #000;
            background-color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-family: "Old English Text MT", serif;
            font-weight: bold;
        }

        .create-account-text:hover {
            color: #fff;
            background-color: #000;
        }

        .about-text {
            margin-right: 20px;
            color: #fff;
            font-family: "Old English Text MT", serif;
            text-decoration: none;
        }

        .about-text:hover {
            text-decoration: underline;
        }

        .content {
            text-align: center;
            margin: 0 auto;
            max-width: 800px;
            background-color: rgba(128, 128, 128, 0.8);
            padding: 20px;
            border-radius: 15px;
            color: #000;
        }

        .container {
            margin-top: 150px;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
        }

        .btn-dark {
            width: 100%;
        }

        .current-info {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .toggle-password {
            cursor: pointer;
            color: #000;
            background-color: #fff;
            border: none;
            padding: 5px;
            border-radius: 5px;
            font-weight: bold;
        }

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background-color: #111111;
            font-size: 20px;
            color: #fff;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            font-family: "Old English Text MT", serif;
            width: 25%;
        }

        .popup-button {
            margin-top: 40px;
            background-color: #070707;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-family: Arial, sans-serif;
            width: 48%;
        }

        .popup-button.cancel {
            background-color: #aaa;
            margin-right: 4%;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="content">
            <h2>Definições</h2>
            <div class="current-info">
                <p>Nome de Usuário: <?php echo $user_name; ?></p>
                <p>Palavra-Passe: <span id="password-toggle">****</span> <button class="toggle-password"
                        onclick="showPasswordPopup('view')">Mostrar</button></p>
            </div>
            <form method="POST" id="update-username-form">
                <div class="mb-3">
                    <label for="new_username" class="form-label">Novo Nome</label>
                    <input type="text" class="form-control" id="new_username" name="new_username" required>
                </div>
                <button type="button" class="btn btn-dark" id="update-username-button"
                    onclick="validateNewUsername()">Atualizar
                    Nome</button>
            </form>
            <br>
            <form method="POST" id="update-password-form">
                <div class="mb-3">
                    <label for="new_password" class="form-label">Nova Palavra-Passe</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <button type="button" class="btn btn-dark" id="update-password-button"
                    onclick="validateNewPassword()">Atualizar
                    Palavra-Passe</button>
            </form>
        </div>
    </div>

    <div class="popup" id="password-popup">
        <div class="popup-content">
            <h3 style="font-family: 'Old English Text MT', serif">Confirme a Palavra-Passe</h3>
            <form id="password-confirmation-form">
                <input type="password" class="form-control" placeholder="Palavra-Passe" id="current_password"
                    name="current_password" required>
                <button type="button" class="popup-button cancel" onclick="closePasswordPopup()">Cancelar</button>
                <button type="submit" class="popup-button">OK</button>
            </form>
        </div>
    </div>

    <script>
        let passwordVisible = false;
        let updateType = '';
        let realPassword = '<?php echo $hashed_password; ?>';

        function showPasswordPopup(type) {
            updateType = type;
            document.getElementById('password-popup').style.display = 'flex';
        }

        function closePasswordPopup() {
            document.getElementById('password-popup').style.display = 'none';
        }

        function validateNewUsername() {
            const newUsername = document.getElementById('new_username').value;
            if (!newUsername) {
                showPopup('Preencha este campo.');
            } else if (newUsername === "<?php echo $user_name; ?>") {
                showPopup('Nome de utilizador já usado por si.');
            } else if (newUsername.length < 3) {
                showPopup('O nome de utilizador deve ter pelo menos 3 caracteres.');
            } else if (newUsername.length > 20) {
                showPopup('O nome de utilizador deve ter menos de 20 caracteres.');
            } else if (newUsername.includes(' ')) {
                showPopup('O nome de utilizador não deve conter espaços.');
            } else if (newUsername.includes('/')) {
                showPopup('O nome de utilizador não deve conter /');
            } else if (newUsername.includes('\\')) {
                showPopup('O nome de utilizador não deve conter \\');
            } else if (newUsername.includes(':')) {
                showPopup('O nome de utilizador não deve conter :');
            } else if (newUsername.includes('*')) {
                showPopup('O nome de utilizador não deve conter *');
            } else if (newUsername.includes('?')) {
                showPopup('O nome de utilizador não deve conter ?');
            } else if (newUsername.includes('"')) {
                showPopup('O nome de utilizador não deve conter "');
            } else if (newUsername.includes('<')) {
                showPopup('O nome de utilizador não deve conter <');
            } else if (newUsername.includes('>')) {
                showPopup('O nome de utilizador não deve conter >');
            } else if (newUsername.includes('|')) {
                showPopup('O nome de utilizador não deve conter |');
            } else if (newUsername.includes(';')) {
                showPopup('O nome de utilizador não deve conter ;');
            } else {
                fetch('check_username.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        username: newUsername,
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            showPopup('Nome de utilizador em uso.');
                        } else {
                            showPasswordPopup('username');
                        }
                    });
            }
        }




        function validateNewPassword() {
            const newPassword = document.getElementById('new_password').value;
            if (!newPassword) {
                showPopup('Preencha este campo.');
            } else if (newPassword.length < 4) {
                showPopup('A palavra-passe deve ter pelo menos 4 caracteres.');
            } else if (newPassword.length > 20) {
                showPopup('A palavra-passe deve ter menos de 20 caracteres.');
            } else if (newPassword === realPassword) {
                showPopup('Palavra-passe não pode ser a mesma que a anterior.');
            } else if (newPassword === '<?php echo $hashed_password; ?>') {
                showPopup('Palavra-passe não pode ser a mesma que a anterior.');
            } else if (newPassword.includes(' ')) {
                showPopup('A palavra-passe não deve conter espaços.');
            } else if (newPassword.includes('/')) {
                showPopup('A palavra-passe não deve conter /');
            } else if (newPassword.includes('\\')) {
                showPopup('A palavra-passe não deve conter \\');
            } else if (newPassword.includes(':')) {
                showPopup('A palavra-passe não deve conter :');
            } else if (newPassword.includes('*')) {
                showPopup('A palavra-passe não deve conter *');
            } else if (newPassword.includes('?')) {
                showPopup('A palavra-passe não deve conter ?');
            } else if (newPassword.includes('"')) {
                showPopup('A palavra-passe não deve conter "');
            } else if (newPassword.includes('<')) {
                showPopup('A palavra-passe não deve conter <');
            } else if (newPassword.includes('>')) {
                showPopup('A palavra-passe não deve conter >');
            } else if (newPassword.includes('|')) {
                showPopup('A palavra-passe não deve conter |');
            } else if (newPassword.includes(';')) {
                showPopup('A palavra-passe não deve conter ;');
            }
            else {
                fetch('verify_password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        password: newPassword,
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showPopup('Palavra-passe já utilizada.');
                        } else {
                            showPasswordPopup('password');
                        }
                    });
            }
        }

        function showPopup(message) {
            const popup = document.createElement('div');
            popup.classList.add('popup');
            popup.innerHTML = `
                <div class="popup-content">
                    <p>${message}</p>
                    <button class="popup-button" onclick="closePopup(this)">OK</button>
                </div>
            `;
            document.body.appendChild(popup);
            popup.style.display = 'flex';
        }

        function closePopup(button) {
            const popup = button.closest('.popup');
            popup.style.display = 'none';
            document.body.removeChild(popup);
        }

        document.getElementById('password-confirmation-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const currentPasswordInput = document.getElementById('current_password').value;

            if (updateType === 'view') {
                fetch('verify_password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        password: currentPasswordInput,
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            realPassword = currentPasswordInput;
                            document.getElementById('password-toggle').textContent = realPassword;
                            closePasswordPopup();
                        } else {
                            alert('Palavra-Passe Incorreta.');
                        }
                    });
            } else if (updateType === 'username') {
                const newUsername = document.getElementById('new_username').value;
                if (newUsername && currentPasswordInput) {
                    document.getElementById('update-username-form').submit();
                } else {
                    alert('Preencha este campo.');
                }
            } else if (updateType === 'password') {
                const newPassword = document.getElementById('new_password').value;
                if (newPassword && currentPasswordInput) {
                    document.getElementById('update-password-form').submit();
                } else {
                    alert('Preencha este campo.');
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>