<?php

require_once "Classes/usuarios.php";

$manitos = new usuarios();

if (isset($_POST["salvar"])) 
{
    $manitos->inserir();
}
$manitos->listarUsuario($_GET['id_usuario']);
$cont = 0;
foreach($manitos as $usuario)
{
    if($cont == 0)
    {
        $id = $usuario;
    }
    elseif ($cont == 1) 
    {
        $nome = $usuario;
    }
    elseif ($cont == 2) 
    {
        $endereco = $usuario;
    }
    elseif ($cont == 3) 
    {
        $telefone = $usuario;
    }
    elseif ($cont == 4) 
    {
        $email = $usuario;
    }
    elseif ($cont == 5) 
    {
        $senha = $usuario;
    }
    $cont++;
}
var_dump($manitos);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="CSS\Style.css">
</head>
<body>
        <div class="frmlogin">
            <h1>Cadastro de Usuário</h1>
            <form action="Cadastro.php" method="POST">
                <?php  
                if(isset($_GET['id_usuario']) && $_GET['id_usuario'] != null)
                {
                    
                }
                
                ?>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" value='<?= 'ff' ?>' required>
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="endereco">Telefone</label>
                    <input type="number" id="endereco" name="telefone" class="form-control" required>
                </div>
                <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Ex: joao@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control" required> 
                    </div>
                <div>
                    <input type="submit" class="btn btn-outline-success" name="salvar" value="Salvar">
                    <?php 
                    if(isset($_SESSION["user"])) 
                    {
                        echo "<a href='perfil.php' class='btn btn-outline-danger'>Voltar</a>";
                    }
                    else {
                        echo "<a href='Index.php' class='btn btn-outline-danger'>Voltar</a>";
                        }
                        ?>
                    
                    
                </div>
            </form>
        </div>
</body>
</html>