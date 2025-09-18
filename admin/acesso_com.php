<?php 
//autenticação do usuairo 
//1 - definir nome da sessão 
session_name('maniaa');
session_start();
//2 - Segurança: Verificar  se a sessão é Válida
if(!isset($_SESSION['login_usuario'])){
    // Usuario não logado, redireciona oara  atela de login 
    header('location: login.php');
    exit;
}
//3 - Verificar se o nome da sessão corresponde a sessão atual 
if(!isset($_SESSION['nome_da_sessao'])){
    $_SESSION['nome_da_sessao'] = session_name();
}elseif($_SESSION['nome_da_sessao']!== session_name()){
    session_destroy();
    header('locatio: login.php');
}
//4 - segurança Extra: Valida o agente (usuario) e o IP

//5 - se IP ou navegador mudarem, invalida asessão
?>