<?php 
include_once "class/produto.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $produto = new Produto();
    $prod = $produto->buscarPorId($id); //  
    // print_r($produto_retorno);
    // exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- Bootstrap 5.3 local  - totalmente moderno e atualizado! -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- CSS local (Nosso) -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Bootstrap JS com parametro defer, que permite a execução js após o carregamento DOM -->
    <script src="js/bootstrap.min.js" defer></script>
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <title>Chuleta Quente</title>
  </head>
<body class="fundo-fixo">
  <header>
     <!-- área de menu  -->
     <?php include 'menu_publico.php'?>
  </header>
  <main class="container">
    <h2 class="alert alert-danger">
        <a href="index.php" class="text-decoration-none">
            <button class="btn btn-danger">
                <span class="bi bi-chevron-left"></span>
            </button>
            Detalhes do Produto - <strong><?=$prod['descricao']?></strong> 
        </a>
    </h2>
    <div class="col-sm-12 col-md-12">
    <div class="card">
              <img
                src="images/<?=$prod['imagem']?>"
                alt="<?=$prod['descricao']?>"
                class="card-img-top"
              />
              <div class="card-body bg-success text-white">
                <h3 class="card-title text-white">
                  <strong><i><?=$prod['descricao']?></i> </strong>
                </h3>
                <p class="text-warning"><strong><?=$prod['rotulo']?></strong></p>
                <p class="card-text text-start">
                    <?=$prod['resumo']?>
                </p>
                <button class="btn btn-default disabled" role="button" style="cursor: default;" >
                    <?="R$ ".number_format($prod['valor'],2,',','.')?>
                </button>

              </div>
            </div>
    </div>
  </main>
       <footer class="container-fluid ps-4 bg-dark text-white p-4 rounded-top" id="CONTATO">
           <a  name="contato"></a>
           <?php  include "rodape.php";?>
            </footer>
</body>
</html>