<?php 
include 'acesso_com.php';
include_once '../class/produto.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $produto = new Produto();
    $produto->excluir($id); // precisa ter esse método na classe Produto

    header("Location: produtos_lista.php"); // volta pra listagem
    exit;
} else {
    echo "ID inválido!";
}
?>