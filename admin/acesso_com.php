<?php 
// autenticação do usuário:
// 1 - definir nome da sessão
session_name('chulettaaa');
session_start();

// $_SESSION['login_usuario'] = "Professor Everson";
// $_SESSION['nome_da_sessao'] = "chulettaaa";

// 2 - Segurança: Verificar se a sessão é válida
if(!isset($_SESSION['login_usuario'])){
    // Usuário não autenticado, redireciona para a tela de login
    header('location: login.php');
    exit;
}
// 3 - Verifica se o nome da sessão corresponde a sessão atual
if(!isset($_SESSION['nome_da_sessao'])){
    $_SESSION['nome_da_sessao'] = session_name();
}elseif($_SESSION['nome_da_sessao']!== session_name()){
    session_destroy();
    header('location: login.php');
    exit;    
}
// 4 - Segurança Extra: valida o agente (usuário) e o IP
if (!isset($_SESSION['ip_usuario'])){
    $_SESSION['ip_usuario']= $_SERVER['REMOTE_ADDR'];
}
if(!isset($_SESSION['user_agent'])){
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
}
// 5 - Se IP ou navegador mudarem, invalida a sessão!
if($_SESSION['ip_usuario']!== $_SERVER['REMOTE_ADDR'] ||
$_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']){
    session_destroy();
    header('location: login.php');
    exit;
}

?>