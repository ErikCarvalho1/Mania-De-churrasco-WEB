<?php
 include 'acesso_com.php';
 include_once '../class/reserva.php';
 $reserva = new reserva();
 $reservas = $reserva->listar();
 $linhas = count($reservas);




?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservas - Lista</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'menu_adm.php'; ?>
    <main class="container my-4">
        <h2 class="alert alert-danger">Lista de reservas</h2>
        <table class="table table-hover table-sm table-warning align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="d-none">ID</th>
                    <th>Data da Reserva</th>
                    <th>Horário</th>
                    <th>Quantidade de Pessoas</th>
                    <th>Motivo</th>
                    <th>Status</th>
                     <th>Data da Atualização</th>

                    <th>
                        <a href="reserva_insere.php" target="_self" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-plus-circle"></i>
                            <span class="d-none d-sm-inline"> ADICIONAR</span>
                        </a>
                    </th>
                </tr>
            </thead>
           
            <tbody>
                 <?php foreach($reservas as $prod):?> 
                    <tr>
                        <td class="d-none">
                            <?=$prod['id']?>
                        </td>
                        <td>
                           <?=$prod['data_reserva']?>
                        </td>
                        <td>
                           <?=$prod['horario']?>
                        </td>
                        <td>
                           <?= $prod['qtd_pessoas']?>
                        </td>
                        <td>
                           <?=$prod['motivo']?>
                        </td>
                        <td>
                           <?=$prod['status_rsv']?>
                        </td>
                          <td>
                           <?=$prod['data_atualizacao']?>
                        </td>
                        <td>
                            <a href="reservas_atualiza.php?id=<?= $prod['id']; ?>"
                               class="btn btn-warning btn-sm w-100 mb-1">
                                <i class="bi bi-arrow-clockwise"></i>
                                <span class="d-none d-sm-inline"> ALTERAR</span>    
                            </a>
 
                           
 
                           <button
    type="button"
    data-nome="<?= htmlspecialchars($prod['motivo']) ?>"
    data-id="<?= (int)$prod['id'] ?>"
    class="btn btn-danger btn-sm w-100 delete"
>
    <i class="bi bi-trash"></i>
    <span class="d-none d-sm-inline">EXCLUIR</span>
</button>
                        </td>
                    </tr>    
               
                    <?php endforeach; ?>
            </tbody>
        </table>
    </main>
 
    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vamos deletar?</h4>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Fechar"></button>
                </div>
          
                <div class="modal-body">
                    Deseja mesmo excluir o item?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger delete-yes">Confirmar</a>
                    <button class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
 =
    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

              document.querySelectorAll('.delete').forEach(btn =>{
            btn.addEventListener('click',function(){
                let nome = this.getAttribute('data-nome');
                let id = this.getAttribute('data-id');
                // console.log(id);
                document.querySelector('span.nome').textContent = nome;
                document.querySelector('a.delete-yes').setAttribute('href', 'reservas_excluir.php?id='+id)
                let modal = new bootstrap.Modal(document.getElementById('modalEdit'));
                modal.show();
            });
        });   

    </script>
 
</body>
</html>

