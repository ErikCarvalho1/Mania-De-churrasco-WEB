<?php 

include "acesso_com.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- Bootstrap 5.3 local  - totalmente moderno e atualizado! -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- CSS local (Nosso) -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Bootstrap JS com parametro defer, que permite a execução js após o carregamento DOM -->
    <script src="../js/bootstrap.min.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js" defer></script>
    <title>Área Administrativa - Mania de Churrasco</title>
</head>
<body>
    <?php include 'menu_adm.php';
        include 'adm_options.php';
    ?>
</body>
</html>