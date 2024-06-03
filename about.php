<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="images/logo.png" />
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
  <!-- Barra de navegação com imagem clicável -->
  <?php include 'navbar.php'; ?>
  <!-- Título -->
  <h1 class="text-center">About Us</h1>
  <!-- Texto -->
  <div class="content">
    <p>
      Opium é uma gravadora e coletiva de rap americano fundado em 2019 pelo
      rapper americano Playboi Carti. A gravadora, com sede em Atlanta,
      Geórgia, possui atualmente quatro artistas, todos nativos da cidade: o
      próprio Playboi Carti, os rappers Ken Carson e Destroy Lonely e a dupla
      Homixide Gang. A gravadora também é afiliada a vários produtores,
      incluindo KP Beatz, F1lthy e Art Dealer, que trabalharam extensivamente
      no segundo álbum de estúdio de Playboi Carti, Whole Lotta Red. Os
      artistas de Opium geralmente apresentam um som e uma estética de rap
      sombrio que se baseia no estilo de "rage rap" de Atlanta e é
      influenciado pela era punk rock dos anos 70 e 80. O estilo "niche" dos
      seus artistas afasta-se dos trap rappers convencionais e conquistou a
      sua própria base de fãs e torcedores.
    </p>
  </div>
  <!-- Scripts do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>