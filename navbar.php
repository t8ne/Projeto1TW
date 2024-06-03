<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isAdmin = isset($_SESSION['username']) && $_SESSION['username'] == 'admin';
$isLoggedIn = isset($_SESSION['username']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="home.php">
            <img src="images/logo2.png" alt="Opium Label" />
        </a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link about-text" href="about.php">About</a>
            </li>
            <?php if ($isAdmin): ?>
                <li class="nav-item">
                    <a class="nav-link about-text" href="dashboard.php">Dashboard</a>
                </li>
            <?php endif; ?>
            <li class="nav-item dropdown">
                <?php if ($isLoggedIn): ?>
                    <a class="nav-link create-account-text dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/person.png" alt="Ícone de Usuário" style="height: 17px; width: 17px;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="user_settings.php">Definições</a></li>
                        <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                    </ul>
                <?php else: ?>
                    <a class="nav-link create-account-text" href="criar_conta.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</nav>

<style>
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

    .dropdown-menu-end {
        right: 0;
        left: auto;
    }
</style>