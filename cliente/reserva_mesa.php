<?php
include_once "../class/reserva.php";

$reserva = new Reserva();

$reserva->setIdClientes(1);
$reserva->setDataReserva($_POST['data_reserva'] ?? null);
$reserva->setHora($_POST['horario'] ?? null);
$reserva->setQtdPessoas($_POST['qtd_pessoas'] ?? null);
$reserva->setMotivo($_POST['motivo'] ?? null);
$reserva->setStatus((int)1 ?? null);
$reserva->setDataCriacao(date('Y-m-d H:i:s')?? null);
$reserva->setDataAtualizacao(date('Y-m-d H:i:s') ?? null);

if ($reserva->inserir()) {
    header("Location: reserva_mesa.php?sucesso=1");
    exit;
} else {
    header("Location: reserva_mesa.php?erro=1");
    exit;
}

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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

    <title>Mania de Churrasco</title>
 </head>
 <body class="fundo-fixo">
    <header>
    <!-- área de menu -->
     <?php include "..//menu_publico.php"?>
    </header>
        <main class="container my-5">
       
    <h2 class="text-center m-4 " >Reserve sua Mesa</h2>
   <form action="processa_reserva.php" method="post" class="mx-auto" style="max-width: 500px;">
    <div class="mb-3">
        <label for="data_reserva" class="form-label">Data da reserva</label>
        <input type="date" class="form-control" id="data_reserva" name="data_reserva" required>
    </div>
    <div class="mb-3">
        <label for="horario" class="form-label">Horário</label>
        <input type="time" class="form-control" id="horario" name="horario" required>
    </div>
    <div class="mb-3">
        <label for="qtd_pessoas" class="form-label">Quantidade de pessoas</label>
        <input type="number" class="form-control" id="qtd_pessoas" name="qtd_pessoas" min="1" max="8" required>
    </div>
    <div class="mb-3">
        <label for="motivo" class="form-label">Observações</label>
        <textarea class="form-control" id="motivo" name="motivo" rows="2"></textarea>
    </div>
    <button type="submit" class="btn btn-danger w-100">Reservar</button>
</form>
</main>        
    </body>
</html>