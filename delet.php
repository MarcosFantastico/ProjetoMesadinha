<?php

require_once "Classes/usuarios.php";

$delet =new usuarios();

$delet->excluir($_SESSION["user"]->id_usuario);
?>