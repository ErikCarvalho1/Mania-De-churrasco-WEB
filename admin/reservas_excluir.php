<?php 
include 'acesso_com.php';
include_once '../class/reserva.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $reserva = new Reserva();
    $reserva->excluir($id); // precisa ter esse método na classe Produto

    header("Location: reservas_listas.php"); // volta pra listagem
    exit;
} else {
    echo "ID inválido!";
}
?>