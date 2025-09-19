<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
      <img src="../images/logo-chuleta.png" alt="Logo" height="30">
    </a>
 
    <!-- Botão toggle para mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#defaultNavbar" aria-controls="defaultNavbar" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
 
    <!-- Menu -->
    <div class="collapse navbar-collapse" id="defaultNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <span class="btn btn-danger disabled me-2" style="cursor: default;">
            Olá, <?=($_SESSION['login_usuario'])?>!
          </span>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php">ADMIN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="produtos_lista.php">PRODUTOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tipos_lista.php">TIPOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usuarios_lista.php">USUÁRIOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">
            <i class="bi bi-house"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>