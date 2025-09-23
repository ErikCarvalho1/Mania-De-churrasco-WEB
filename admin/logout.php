<?php 
session_name('maniaa');
session_start();
session_destroy(); // ao usar destroy, você obriga o usuario a refazer login 
header('location: ../index.php');
exit;

?>