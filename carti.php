<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$isAdmin = $isLoggedIn && $_SESSION['username'] === 'admin';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Playboi Carti</title>
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
      background-image: url("images/carti.jpg");
      background-size: cover;
    }

    .content {
      height: 778px;
      background-color: #000000;
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

    .carti-container {
      background-color: white;
      border-radius: 15px;
      width: 500px;
      height: 640px;
      padding: 70px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(40%, -43.5%);
      font-size: 10px;
    }

    .carti-container h2 {
      text-align: center;
      font-weight: bold;
    }

    .carti-form {
      margin-top: 20px;
    }

    .carti-form input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #000000;
      border-radius: 5px;
    }

    .carti-form button {
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

    .about-text {
      margin-right: 20px;
      color: #fff;
      font-family: "Old English Text MT", serif;
      text-decoration: none;
    }

    .about-text:hover {
      text-decoration: underline;
    }

    .blurred-content {
      position: relative;
    }

    .blurred-content::after {
      content: '';
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
      color: black;
      font-weight: bold;
      font-size: 24px;
      padding: 20px;
      box-sizing: border-box;
      flex-direction: column;
    }

    .blurred-content.logged-out::after {
      display: flex;
      content: 'Inicie sessão para continuar a ler';
    }
  </style>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="image">
    <div class="carti-container">
      <h2 style="margin-top: -30px;">OPIUM</h2>
      <h2>🞹</h2>
      <h2></h2>
      <h2>Playboi Carti</h2>
      <br />
      <h3 style="font-family: 'Jokcey One', serif">
        O rapper Playboi Carti nascido em 13 de setembro de 1996 em Atlanta,
        Geória, EUA é o fundador e músico principal da gravadora OPIUM 🞹. É
        um dos rappers mais influentes da nova geração e é dos pioneiros da
        nova onda "rage rap". Conta com 3 álbuns que contribuíram para uma
        mudança no panorama do trap que renovou o género com novos estilos.
      </h3>
    </div>
  </div>

  <div class="container mt-4 blurred-content <?php echo !$isLoggedIn ? 'logged-out' : ''; ?>">
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

  <!-- Bootstrap JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script>
    const infoArista = async () => {
      const response = await fetch(
        "https://run.mocky.io/v3/066ef73b-146d-407e-b7d3-e6a2e83a1113"
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
          "https://run.mocky.io/v3/72c659cc-d7cf-4f4b-bd3f-be218fb068b6",
          "https://run.mocky.io/v3/3fdd0e17-10a7-473f-b64d-14cec0a411b6",
          "https://run.mocky.io/v3/a91aa6a2-32e8-4c87-ba68-87adef7f0093",
          "https://run.mocky.io/v3/e31e21f1-70cf-4c1b-b130-859ec9dd9c95",
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
      document.getElementById(`tracks_${index}_${albumId}`).innerHTML = tracksHtml;
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
        const confirmDelete = confirm("Tem a certeza que quer eliminar este álbum?");
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