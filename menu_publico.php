<?php 

include "class/db.php";


$pdo = getConnection();
$tipo_lista = $pdo->query("select * from tipos");
$tipos = $tipo_lista->fetchAll();


?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand"> 
                    <img src="images/Logo Mania.png" alt="LogoTipo " width="190"/>
                </a>
                <button 
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menupublico"
                    aria-controls="menupublico"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menupublico">
                    <ul class="navbar-nav ms-auto mb-2 mb-m-0">
                        <li class="nav-item">
                            <a href="index.html" class="nav-link active" area-current="page">
                                <i class="bi bi-house-door-fill"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">DESTAQUES</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">PRODUTOS</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">TIPOS</a>
                            
                            <ul class="dropdown-menu dropdown-menu-dar">
                                <?php foreach ($tipos as $tipo):?>
                                <li><a href="produtos_por_tipo.php?tipo_id=1<?= $tipo['id'];?> " class="dropdown-item" <?=$tipo['rotulo']?>></a></li>
                                <?php endforeach;?>
                            
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#contato" class="nav-link">CONTATO</a>
                        </li>
                        <li class="nav-item">
                            <form class="d-flex" role="search">
                                <input type="search" class="form-control me-2" placeholder="Buscar produto" aria-label="search" required />
                                <button class="btn btn-outline-light">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link">
                            <i class="bi bi-person-fill"></i>&nbsp;<ADMIN>
                            <CLIENTE></CLIENTE>
                        </a>
                        
                        </li>
                   </ul>
                </div>
            </div>
        </nav>
        