<?php

if(isset($_SESSION["usuario"]))
{

}

require_once "Classes/usuarios.php";

$usuario = new usuarios();

if(isset($_POST["Logar"])){
    $usuario->login();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mesadinha </title>

<!-- Boostrap -->
<link rel="stylesheet" href="CSS\bootstrap.min.css">
<link rel="stylesheet" href="CSS\Style.css">
</head>
<body>
        <div class="frmlogin">
            <h1>Login</h1>
            <form action="autenticar.php" method="POST">
                <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ex: joao@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" required> 
                </div>
                <div class="meio">
                    <button class="btn btn-outline-success">Entrar</button>
                    <a href="Cadastro.php" class="btn btn-outline-primary"> Registre-se </a>
                </div>
            </form>
        </div>
</body>
</html>