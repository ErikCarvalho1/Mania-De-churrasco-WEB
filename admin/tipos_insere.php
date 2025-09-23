<?php 
include 'acesso_com.php';
include_once '../class/tipo.php';


    
    
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sigla  = $_POST['sigla']  ?? null;
    $rotulo = $_POST['rotulo'] ?? null;

    if ($sigla && $rotulo) {
        $tipo = new Tipo();
        $tipo->setSigla($sigla);
        $tipo->setRotulo($rotulo);

        if ($tipo->inserirTipo()) {
            header("Location: tipos_lista.php");
            exit;
        } else {
            echo "Erro ao inserir tipo!";
        }
    } else {
        echo "Preencha todos os campos!";
    }
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilo.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<title>Produto - Insere</title>
</head>
<body>
<?php include "menu_adm.php";?>
<main class="container my-4">
<div class="row justify-content-center">
<div class="col-12 col-sm-8 col-md-8">
<h2 class="breadcrumb text-danger d-flex align-items-center">
<a href="produtos_lista.php" class="me-2">
<button class="btn btn-danger">
<i class="bi bi-chevron-left"></i>
</button>
</a>
                Inserindo Produtos
</h2>
 
            <div class="card shadow-sm">
<div class="card-body">
<form action="tipos_insere.php" method="post" 
                        name="form_insere" enctype="multipart/form-data"
                        id="form_insere">
 

        

                        <!-- Descrição -->
<div class="mb-3">
<label for="sigla" class="form-label">sigla:</label> 
<div class="input-group">
<span class="input-group-text"><i class="bi bi-egg-fried"></i></span>
<input type="text" name="sigla" id="sigla" 
                                    class="form-control" placeholder="Digite a descrição do Produto"
                                    maxlength="100" required>
</div>
</div>
 
                        Resumo
 <div class="mb-3">
<label for="rotulo" class="form-label">Resumo:</label>
<div class="input-group">
<span class="input-group-text"><i class="bi bi-card-text"></i></span>
<textarea name="rotulo" id="rotulo" cols="30" rows="8"
                                    class="form-control" placeholder="Digite os detalhes do Produto" required></textarea>
</div>
</div>
 
 
                        <!-- Botão -->
<div class="d-grid">
<input type="submit" name="enviar" id="enviar" class="btn btn-danger w-100" value="Cadastrar">
</div>
 
                    </form>
</div>
</div>
 
        </div>
</div>
</main>
</body>
</html>
