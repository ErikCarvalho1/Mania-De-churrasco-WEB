<?php 
require_once "../class/usuario.php";
if($_POST){
  $login = $_POST['login'];
  $senha = $_POST['senha'];
  $user = new Usuario();
  $usuarioLogado = $user->efetuarLogin($login,$senha);
  // print_r($usuarioLogado);
  // exit;
  if(count($usuarioLogado)>0){
    if(!isset($_SESSION)){
      session_name("chulettaaa");
      session_start();
    }
    $_SESSION['login_usuario'] = $usuarioLogado['login'];
    $_SESSION['nivel_usuario'] = $usuarioLogado['nivel'];
    $_SESSION['nome_da_sessao'] = session_name();
    if($usuarioLogado['nivel']=="adm"){
      echo "<script>window.open('index.php','_self')</script>"; 
    }elseif($usuarioLogado['nivel']=="cli"){
      echo "<script>window.open('../cliente/index.php','_self')</script>"; 
    }
    
  }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="30;url=../index.php">
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- Bootstrap 5.3 local  - totalmente moderno e atualizado! -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- CSS local (Nosso) -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Bootstrap JS com parametro defer, que permite a execução js após o carregamento DOM -->
    <script src="../js/bootstrap.min.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js" defer></script>
    <title>Chuleta Quente</title>
  </head>

<body>
    <main class="container my-5">
  <section>
    <article>
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          <h1 class="text-info text-center mb-4">Faça seu login</h1>

          <div class="card shadow-lg">
            <div class="card-body">
              <p class="text-info text-center mb-4" role="alert">
                <i class="bi bi-people-fill display-1"></i>
              </p>

              <div class="alert alert-info" role="alert">
                <form action="login.php" name="form_login" id="form_login" method="POST" enctype="multipart/form-data">
                  
                  <!-- Login -->
                  <div class="mb-3">
                    <label for="login" class="form-label">Login:</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-person-fill text-info"></i>
                      </span>
                      <input type="text" name="login" id="login" 
                             class="form-control" 
                             placeholder="Digite seu login" 
                             autofocus required autocomplete="off">
                    </div>
                  </div>

                  <!-- Senha -->
                  <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-lock-fill text-info"></i>
                      </span>
                      <input type="password" name="senha" id="senha" 
                             class="form-control" 
                             placeholder="Digite sua senha" 
                             required autocomplete="off">
                    </div>
                  </div>

                  <!-- Botão -->
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                  </div>
                </form>
              </div>

              <p class="text-center mt-3">
                <small>
                  Caso não faça uma escolha em 30 segundos será redirecionado automaticamente para página inicial.
                </small>
              </p>
            </div>
          </div>
        </div>
      </div>
    </article>
  </section>
</main>
</body>
</html>