<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homixide Gang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="images/logo2.png" />
  <style>
    body {
      margin: 0;
      animation: fadeIn 2s;
    }

    @keyframes fadeIn {
      from {
        opacity: 0.65;
      }

      to {
        opacity: 1;
      }
    }

    .navbar {
      animation: none !important;
    }

    .image {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100vh;
      background: black;
      background-image: url("images/Homixide.jpg");
      /* Correção da barra invertida */
      background-size: cover;
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

    .content {
      height: 778px;
      background-color: #000000;
    }

    .homixide-container {
      background-color: white;
      border-radius: 15px;
      width: 400px;
      /* change the width of the container */
      height: 640px;
      padding: 70px;
      /* Adiciona espaçamento interno ao redor do contêiner */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-185%, -43.5%);
      font-size: 10px;
    }

    .homixide-container h2 {
      text-align: center;
      font-weight: bold;
    }

    .homixide-form {
      margin-top: 20px;
    }

    .homixide-form input {
      width: 100%;
      /* Define a largura dos campos de entrada como 100% */
      padding: 10px;
      /* Adiciona espaçamento interno aos campos de entrada */
      margin-bottom: 10px;
      /* Adiciona margem inferior aos campos de entrada */
      border: 1px solid #000000;
      /* Adiciona uma borda aos campos de entrada */
      border-radius: 5px;
    }

    .homixide-form button {
      width: 100%;
      /* Define a largura do botão de login como 100% */
      padding: 10px;
      /* Adiciona espaçamento interno ao botão de login */
      background-color: #171717;
      /* Define a cor de fundo do botão de login */
      color: rgb(255, 255, 255);
      /* Define a cor do texto do botão de login */
      border: none;
      /* Remove a borda do botão de login */
      border-radius: 5px;
      /* Adiciona cantos arredondados ao botão de login */
      cursor: pointer;
      /* Altera o cursor ao passar o mouse sobre o botão de login */
      font-weight: bold;
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

    /* Estilos para o popup */
    .popup {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,
          0,
          0,
          0.5);
      /* Cor de fundo escura com opacidade */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 999;
      /* Para garantir que o popup esteja na frente de outros elementos */
    }

    .popup-content {
      background-color: #111111;
      font-size: 10px;
      color: #fff;
      padding: 40px;
      /* Aumenta o espaçamento interno */
      border-radius: 10px;
      text-align: center;
      font-family: "Old English Text MT", serif;
      /* Definir a fonte Old English */
      width: 25%;
      /* Define a largura do popup */
    }

    .popup-button {
      margin-top: 40px;
      background-color: #070707;
      /* Altera a cor de fundo para preto */
      color: #fff;
      /* Altera a cor do texto para branco */
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      /* Torna o texto em negrito */
      font-family: Arial, sans-serif;
      width: 100%;
    }
    
    .texto{
      font-family: "Old English Text MT", serif;
      align-items: center;
      justify-content: center;
      text-align: center;
      font-size: 20px;
      transform: translate(0, -1400%);
    }

    .blurred-content {
      position: relative;
    }

    .blurred-content::after {
      content: 'Inicie sessão para continuar a ler';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.7);
      display: none;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      font-weight: bold;
      font-size: 24px;
      padding: 20px;
      box-sizing: border-box;
      flex-direction: column;
      pointer-events: none;
    }

    .blurred-content.logged-out::after {
      display: flex;
    }

    .logged-out .blurred-content::after {
      display:flex;
    }

    .logged-in .blurred-content::after {
      display:none;
    }
  </style>
</head>

<body class="logged-out">
  <?php include 'navbar.php'; ?>
  <div class="image">
    <div class="homixide-container">
      <h2 style="margin-top: -30px;">OPIUM</h2>
      <h2>🞹</h2>
      <h2></h2>
      <h2>Homixide Gang</h2>
      <br />
      <h3 style="font-family: 'Jockey One', serif">
        O grupo dos Homixide Gang é constítuido pelo Homixide Beno (esquerda)
        e o Homixide Meechie (direita). Ambos os músicos participam em todos
        os seus sons produzindo um tipo de música agressiva, e dentro da OPIUM
        são o único grupo musical.
      </h3>
    </div>
  </div>

  <div class="container mt-4 blurred-content <?php echo !$isLoggedIn ? 'logged-out' : ''; ?>">
    <div class="container mt-4">
      <h1>Álbuns</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Foto do álbum</th>
            <th>Nome do álbum</th>
            <?php if ($isAdmin): ?>
              <th>Ações</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody id="albums">
          <tr>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <a href="/ProjetoTW/criar_conta.php" class="login-link">
    <div class="texto logged-out" >
      <p>Inicie a sessão para continuar a ler</p>
    </div>
  </a>

  <!-- Bootstrap JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script>
    const infoArista = async () => {
      const response = await fetch(
        "https://run.mocky.io/v3/8d6448d2-bdca-444a-8562-d2fd281113a3"
      );
      const albums = await response.json();

      let albumRows = "";
      for (let i = 0; i < albums.items.length; i++) {
        const album = albums.items[i];
        albumRows += `
          <tr id="album_row_${i}">
                        <td>
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="${album.images[0].url}" width="100px" height="100px" alt="${album.name}" />
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">${album.name}</li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item"><b>Tracks</b></a></li>
                                <div class="container">
                                    <div class="row" id="tracks_${i}_${album.id}">
                                        Loading tracks...
                                    </div>
                                </div>
                            </ul>
                        </td>
                        <td id="album_name_${i}">${album.name} - ${album.release_date}</td>
                        <?php if ($isAdmin): ?>
                                  <td>
                                    <button class="btn btn-outline-primary edit-button" data-index="${i}">Editar</button>
                                    <button class="btn btn-outline-danger delete-button" data-index="${i}">Eliminar</button>
                                  </td>
            <?php endif; ?>
          </tr>
          `;

        fetchTracks(album.id, i);
      }

      document.getElementById("albums").innerHTML = albumRows;
    };

    const fetchTracks = async (albumId, index) => {
      const response = await fetch(
        [
          "https://run.mocky.io/v3/172449f7-77b3-42cf-b518-29e9f8a0fdba",
          "https://run.mocky.io/v3/d5720541-1a6a-4be8-badb-7888a746f718",
          "https://run.mocky.io/v3/a52e6665-933e-490b-b9e0-b7d53d829ed1",
          "https://run.mocky.io/v3/0f1778ed-bf21-4844-90b2-03bbe8320376",
          "https://run.mocky.io/v3/718c39f5-d77c-48a0-a417-b5da23b74f7b",
        ][index]
      );
      const tracks = await response.json();
      let tracksHtml = "";
      for (let i = 0; i < tracks.items.length; i++) {
        const track = tracks.items[i];
        const duration = millisToMinutesAndSeconds(track.duration_ms);
        tracksHtml += `
            <div class="col-md-6">${track.name} - ${duration}</div>
          `;
      }
      document.getElementById(`tracks_${index}_${albumId}`).innerHTML =
        tracksHtml;
    };

    const millisToMinutesAndSeconds = (millis) => {
      const minutes = Math.floor(millis / 60000);
      const seconds = ((millis % 60000) / 1000).toFixed(0);
      return `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
    };

    // Function to handle editing album name
    const editAlbumName = (index, newName) => {
      const albumNameElement = document.getElementById(`album_name_${index}`);
      albumNameElement.textContent = newName;
    };

    // Function to handle deleting album row
    const deleteAlbumRow = (index) => {
      const rowToDelete = document.getElementById(`album_row_${index}`);
      rowToDelete.remove();
    };

    // Event listener for editing button
    document.addEventListener("click", (event) => {
      if (event.target.classList.contains("edit-button")) {
        const index = event.target.getAttribute("data-index");
        const newName = prompt("Digite um novo nome para o álbum:");
        if (newName !== null && newName !== "") {
          editAlbumName(index, newName);
        }
      }
    });

    // Event listener for deleting button
    document.addEventListener("click", (event) => {
      if (event.target.classList.contains("delete-button")) {
        const index = event.target.getAttribute("data-index");
        const confirmDelete = confirm(
          "Tem a certeza que quer eliminar este álbum?"
        );
        if (confirmDelete) {
          deleteAlbumRow(index);
        }
      }
    });

    // Call the function to fetch album information
    infoArista();
  </script>
</body>

</html>