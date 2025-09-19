       
<?php 
         if(isset($_GET['tipo_id'])){
            $tipo_id = $_GET['tipo_id'];
include_once "class/produto.php";
$produto = new Produto();
$produtos = $produto->buscarPorTipoId(  $tipo_id); 


$linha = count($produtos);
}?>

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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- CSS local (Nosso) -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Bootstrap JS com parametro defer, que permite a execução js após o carregamento DOM -->
    <script src="js/bootstrap.min.js" defer></script>
    <script src="js/bootstrap.bundle.min.js" defer></script>

    <title>Mania de Churrasco</title>
 </head>
 <body class="fundo-fixo">
    <header>
    <!-- área de menu -->
     <?php include "menu_publico.php"?>
    </header>
    <main class = "container" >  

<section>
   
<!-- mostra se a consulta retornar vazio  -->
 <?php 
 if($linha == 0){ ?>
<h2 class="alert alert-danger
                ">Não há produtos em destaques</h2>
 <?php } ?>

<?php if($linha > 0 ){?>
<h2 class="alert alert-primary
                ">Produtos Em Destaques</h2>
                <div class="row">
                    <?php  foreach($produtos as $prod):?>
                    <!-- começa o card produto -->
          
                            <!-- começa o card produto -->
                 <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card">
                            <img s src="images/<?=$prod['imagem'] ?>"
                             alt = "<?=$prod['descricao'] ?>"
                              class="card-img-top">
                            <div class="card-body bg-success text-whith">
                                <h3 class="card-title text-danger">
                                    <strong><i><?=$prod['descricao']?></i></strong>
                                </h3>
                                <p class="text-warning"><strong><?=$prod['rotulo'] ?></strong>
                                <p class="card-text text-start">
                                    <?=mb_strimwidth($prod['resumo'],0,42,'...') ?>
                                </p>
                                </p>
                                <button class="btn btn-default disabled" role="button" style="cursor: default;">
                                    <?="R$ ".number_format($prod['valor'],2,',','.')?>

                                </button>
                                <a href="detalhes_produtos.php?id=<?= $prod['id']?>" class="btn btn-primary float-end">
                                    <span class="d-nome d-sm-inline">Saiba mais</span>
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                        </div>
                        </div>
                    </div><!-- termina o card produto -->
                 
                  
                    <?php endforeach;?>
                </div>
                <?php }?>
            </section>
    </main>
     <!-- rodape -->
             <footer class="container-fluid ps-4 bg-dark text-white p-4 rounded-top" id="CONTATO">
           <a  name="contato"></a>
           <?php  include "rodape.php";?>
            </footer>
 </body>
 
 </html>