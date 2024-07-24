<?php session_start();
unset($_SESSION['id_usuario'], $_SESSION['nome_usuario']);
$_SESSION['inf'] = "<p class='inf'> Deslogado com sucesso </p>";


header("refresh:1;url= ../../pages/login/login.php");

?>