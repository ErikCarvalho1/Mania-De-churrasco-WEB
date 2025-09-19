<?php 
session_name('maniaa');
session_start();
?>

<h1>Area exlusiva do cliente</h1>
<h2>Área exclusiva de <?=$_SESSION['login_usuairo']?></h2>

<a href="..admin/logout.php"></a>