
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
        <main class="container my-5">
       
    <h2 class="text-center m-4 " >Reserve sua Mesa</h2>
    <form action="processa_reserva.php" method="post" class="mx-auto" style="max-width: 500px;">
       
        <div class="mb-3">
            <label for="data" class="form-label">Data da reserva</label>
            <input type="date" class="form-control" id="data" name="data" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Horário</label>
            <input type="time" class="form-control" id="hora" name="hora" required>
        </div>
        <div class="mb-3">
            <label for="qtd_pessoas" class="form-label">Quantidade de pessoas</label>
            <input type="number" class="form-control" id="qtd_pessoas" name="qtd_pessoas" min="1" max="8" required>
        </div>
        <div class="mb-3">
            <label for="observacoes" class="form-label">Observações</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="2"></textarea>
        </div>
        <button type="submit" class="btn btn-danger w-100">Reservar</button>
    </form>
</main>        
    </body>