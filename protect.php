<?php 

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die("VocÊ não pode acessar esta página porque não esá logado. <p><a href\"login-tecnico.php\">Entrar</a></p>");
}
?>