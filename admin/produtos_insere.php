
<?php 
include 'acesso_com.php';
include_once '../class/produto.php';
if($_POST){
    if(isset($_POST['enviar'])){
        $nome_img = $_FILES['imagemfile']['name'];
        $tmp_img = $_FILES['imagemfile']['tmp_name'];
       
    }
    $produto  = new Produto();
    $produto->setcategoriasId($_POST['categorias_id']);
    $produto->setDestaque($_POST['destaque']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setResumo($_POST['resumo']);
    $produto->setResumo($_POST['imagem']);
    $produto->setValor($_POST['valor']);
    
    if($produto->inserir()){
        header('location: produtos.php');
    }else{  
        // lembrar de remover a imagem carregada para a pasta IMAGES        
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
                    <form action="produtos_insere.php" method="post" 
                        name="form_insere" enctype="multipart/form-data"
                        id="form_insere">

                        <!-- Tipo -->
                        <div class="mb-3">
                            <label for="categorias_id" class="form-label">Tipo:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                <select name="categorias_id" id="categorias_id" class="form-select" required>
                                    <option value="1">2</option>
                                    <option value="2">Sobremesa</option>
                                    <option value="3">Bebidas</option>
                                </select>
                            </div>
                        </div>

                        <!-- Destaque -->
                        <div class="mb-3">
                            <label class="form-label">Destaque:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="destaque" id="destaque_s" value="1" >
                                    <label class="form-check-label" for="destaque_s">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="destaque" id="destaque_n" value="0" checked>
                                    <label class="form-check-label" for="destaque_n">Não</label>
                                </div>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-egg-fried"></i></span>
                                <input type="text" name="descricao" id="descricao" 
                                    class="form-control" placeholder="Digite a descrição do Produto"
                                    maxlength="100" required>
                            </div>
                        </div>

                        <!-- Resumo -->
                        <div class="mb-3">
                            <label for="resumo" class="form-label">Resumo:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                <textarea name="resumo" id="resumo" cols="30" rows="8"
                                    class="form-control" placeholder="Digite os detalhes do Produto" required></textarea>
                            </div>
                        </div>

                        <!-- Valor -->
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                <input type="number" name="valor" id="valor" 
                                    class="form-control" required min="0" step="0.01">
                            </div>
                        </div>

                        <!-- Imagem -->
                        <div class="mb-3">
                            <label for="imagemfile" class="form-label">Imagem:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                <input type="file" name="imagemfile" id="imagemfile" class="form-control" accept="image/*">
                            </div>
                            <img src="" name="imagem" id="imagem" class="img-fluid mt-2" alt="Pré-visualização da imagem">
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
<script>
document.getElementById("imagemfile").onchange = function(){
    var file = this.files[0];
    var reader = new FileReader();

    // valida tamanho (500 KB)
    if(file.size > 512000){
        alert("A imagem deve ter no máximo 500KB");
        this.value = ""; // reseta input
        document.getElementById("imagem").src = "";
        document.getElementById("imagem").style.display = "none";
        return false;
    }

    // valida formato
    if(file.type.indexOf("image") === -1){
        alert("Formato inválido! Escolha uma imagem.");
        this.value = "";
        document.getElementById("imagem").src = "";
        document.getElementById("imagem").style.display = "none";
        return false;
    }

    // pré-visualização
    reader.onload = function(e){
        document.getElementById("imagem").src = e.target.result;
        document.getElementById("imagem").style.display = "block";
    }
    reader.readAsDataURL(file);
}
</script>


</body>
</html>
