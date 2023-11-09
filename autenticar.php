<?php
require "Classes/usuarios.php";
$login = new usuarios();
$login->validaraluno($_POST["email"], $_POST["senha"]);
?>