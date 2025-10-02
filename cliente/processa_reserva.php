<?php
include_once "../class/reserva.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reserva = new Reserva();

    $reserva->setIdClientes(1);
    $reserva->setDataReserva($_POST['data_reserva'] ?? date('Y-m-d'));
    $reserva->setHorario($_POST['horario'] ?? date('H:i:s'));
    $reserva->setQtdPessoas($_POST['qtd_pessoas'] ?? 1);
    $reserva->setMotivo($_POST['motivo'] ?? 'Sem observações');
    $reserva->setStatusRsv(1); // bit(1) -> 0 ou 1
    $reserva->setDataCriacao(date('Y-m-d H:i:s'));
    $reserva->setDataAtualizacao(date('Y-m-d H:i:s'));

    if ($reserva->inserir()) {
        header("Location: reserva_mesa.php?sucesso=1");
        exit;
    } else {
        header("Location: reserva_mesa.php?erro=1");
        exit;
    }
} else {
    header("Location: reserva_mesa.php");
    exit;
}
