<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Criar Conta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="images/logo.png" />
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-image: url("images/conc.jpg");
      background-size: cover;
    }

    .login-container {
      background-color: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
      text-align: center;
      font-weight: bold;
    }

    .login-form {
      margin-top: 20px;
    }

    .login-form input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #000000;
      border-radius: 5px;
    }

    .login-form button {
      width: 100%;
      padding: 10px;
      background-color: #171717;
      color: rgb(255, 255, 255);
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
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

    .popup {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
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
      width: 100%;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="home.php">
        <img src="images/logo2.png" alt="Opium Label" />
      </a>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link about-text" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link create-account-text" href="criar_conta.php">Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="login-container">
    <h2>Criar Conta 🞹</h2>
    <form class="login-form 🞹" id="register-form">
      <input type="text" placeholder="Nome de Usuário" id="username" required />
      <input type="password" placeholder="Palavra-Passe" id="password" required />
      <button type="submit">Criar Conta</button>
    </form>
  </div>

  <div class="popup" id="popup" style="display: none">
    <div class="popup-content">
      <h3 style="font-family: 'Old English Text MT', serif">Conta Criada</h3>
      <button class="popup-button" onclick="returnHome()">OK</button>
    </div>
  </div>

  <script>
    function showPopup() {
      document.getElementById("popup").style.display = "flex";
    }

    function returnHome() {
      window.location.href = "home.php";
    }

    document
      .getElementById("register-form")
      .addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        fetch("register.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ username, password }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              showPopup();
            } else {
              alert("Erro ao criar conta.");
            }
          })
          .catch((error) => console.error("Error:", error));
      });
  </script>
</body>

</html>