<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Opium Label</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <link rel="icon" type="image/png" href="images/logo.png" />
  <style>
    /* Estilos personalizados */
    body {
      background-color: #000;
      /* Fundo preto */
      color: #ffffff;
      /* Texto branco */
      font-family: Arial, sans-serif;
      /* Definir a fonte */
      margin-bottom: 50px;
      /* Espaçamento na parte inferior para o footer */
      position: relative;
      min-height: 100vh;
      /* Garantir que o corpo ocupe pelo menos toda a altura da janela */
    }

    .artist-card {
      margin-bottom: 20px;
      border: 3px solid #fff;
      /* Contorno branco */
      border-radius: 10px;
      /* Cantos arredondados */
      overflow: hidden;
      /* Ocultar qualquer parte da imagem que ultrapasse o contorno */
      text-align: center;
      /* Centralizar a imagem horizontalmente */
      position: relative;
      /* Permitir posicionamento relativo para a legenda */
    }

    .artist-card img {
      max-width: 630px;
      /* Definir um tamanho máximo para as imagens */
      width: 100%;
      height: auto;
      /* Deixar a altura automática para manter a proporção original da imagem */
      display: inline-block;
      /* Permitir centralizar a imagem horizontalmente */
    }

    .artist-card figcaption {
      position: absolute;
      /* Posicionar absolutamente a legenda */
      bottom: 0;
      /* Alinhar a legenda na parte inferior da imagem */
      left: 0;
      /* Alinhar a legenda à esquerda da imagem */
      width: 100%;
      /* Definir a largura da legenda como 100% da imagem */
      background-color: rgba(0, 0, 0, 0.5);
      /* Fundo semi-transparente */
      padding: 10px;
      /* Adicionar preenchimento interno à legenda */
      margin: 0;
      /* Remover margens da legenda */
      font-style: italic;
      /* Deixar a legenda em itálico */
      color: #fff;
      /* Cor do texto branco */
    }

    .navbar-brand img {
      max-width: 50px;
      /* Tornar o logotipo um pouco menor */
      height: auto;
    }

    .row-cols-md-2 [class^="col"] {
      padding-right: 25px;
      /* Adicionar espaçamento lateral direito entre as colunas */
      padding-left: 25px;
      /* Adicionar espaçamento lateral esquerdo entre as colunas */
    }

    .navbar {
      background-color: #000 !important;
      /* Cor de fundo da barra de navegação preta */
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

    /* Estilos para o carousel */
    #carousel-opium {
      position: relative;
    }

    #carousel-opium .carousel-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #ffffff;
      /* Cor do texto branco */
      font-size: 150px;
      /* Tamanho gigante */
      font-family: "Old English Text MT", serif;
      /* Definir a fonte Old English */
      text-shadow: 2px 2px 4px #000000;
      /* Sombra no texto */
    }

    #carousel-opium .carousel-item img {
      width: 100%;
      height: auto;
    }

    /* Estilos para o título "Members" */
    .members-title {
      text-align: center;
      font-size: 70px;
      /* Tamanho gigante */
      font-family: "Old English Text MT", serif;
      /* Definir a fonte Old English */
      color: #ffffff;
      /* Cor do texto branco */
      margin-top: 80px;
      /* Espaçamento superior */
      margin-bottom: 80px;
      /* Espaçamento superior */
    }

    .footer-content {
      font-size: 13px;
      color: darkgrey;
      font-style: italic;
    }

    .align-right {
      float: right;
    }
  </style>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <!-- Carousel -->
  <div id="carousel-opium" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/RIP.gif" class="d-block w-100" alt="..." />
        <div class="carousel-caption">Opium</div>
      </div>
    </div>
  </div>

  <!-- Título "Members" -->
  <h1 class="members-title">Members</h1>

  <!-- Conteúdo principal -->
  <div class="container mt-4 animate-on-scroll">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <!-- Playboi Carti -->
      <div class="col">
        <div class="artist-card">
          <a href="carti.php">
            <img src="images/pbCarti.jpg" class="img-fluid" alt="Playboi Carti" />
          </a>
          <figcaption>Playboi Carti</figcaption>
        </div>
      </div>
      <!-- Ken Carson -->
      <div class="col">
        <div class="artist-card">
          <a href="ken.php">
            <img src="images/carson.jpg" class="img-fluid" alt="Ken Carson" />
          </a>
          <figcaption>Ken Carson</figcaption>
        </div>
      </div>
      <!-- Destroy Lonely -->
      <div class="col">
        <div class="artist-card">
          <a href="lonely.php">
            <img src="images/destruidorsolitario.jpg" class="img-fluid" alt="Destroy Lonely" />
          </a>
          <figcaption>Destroy Lonely</figcaption>
        </div>
      </div>
      <!-- Homixide Beno -->
      <div class="col">
        <div class="artist-card">
          <a href="hmxgang.php">
            <img src="images/hmxgang.jpg" class="img-fluid" alt="Homixide Gang" />
          </a>
          <figcaption>Homixide Gang</figcaption>
        </div>
      </div>
    </div>
  </div>
  <br />
  <br />
  <br />

  <!-- Footer -->
  <footer>
    <div class="container footer-content">
      <div>
        <p>
          António Rebelo Nº28837&nbsp;<span class="align-right">ESTG-IPVC</span>
        </p>
        <p>
          Mateus Viana Nº29772&nbsp;<span class="align-right">Av. do Atlântico 644 4900 Viana do Castelo</span>
        </p>
        <p>
          Eduardo Couto Nº28879&nbsp;<span class="align-right">258 819 700</span>
        </p>
      </div>
    </div>
  </footer>

  <!-- Scripts do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      function animateOnScroll() {
        const elements = document.querySelectorAll('.animate-on-scroll');
        elements.forEach(function (element) {
          const position = element.getBoundingClientRect();
          if (position.top < window.innerHeight && position.bottom >= 0) {
            element.classList.add('animate__animated', 'animate__fadeIn');
          }
        });
      }

      window.addEventListener('scroll', animateOnScroll);
      animateOnScroll();
    });
  </script>
</body>

</html>