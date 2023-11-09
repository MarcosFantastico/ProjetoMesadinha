<?php
header ("Content-type:text/html; charset=UTF8");
require_once "Classes/usuarios.php";
$alunos = new usuario();

if(isset($_SESSION["user"])){
    $dadosAluno = $alunos->listarID($_SESSION["user"]);

}
if(isset($_POST["alterar"])){
    $alunos->alterar();
}


?>