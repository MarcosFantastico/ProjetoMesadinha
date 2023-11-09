
<?php
require_once "Classes/usuarios.php";

$usuario = new usuarios();

$listausuarios = $usuario->listartodos();


/*
if (isset($_POST["Excluir"])) 
{
    $delet->excluir($id_usuario);
}
*/
if(isset($_GET["id_usuario"]))
{
  //die();
  $usuario->excluir($_GET["id_usuario"]);
}
//var_dump($_GET);

?>

<!doctype html>

<html lang="pt-br" class="h-100">
  <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <link rel="stylesheet" type="text/css" href="css/style.css">
      <title>Página inicial</title>

      <!-- Principal CSS do Bootstrap -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="d-flex flex-column h-100">

    <header>
      <!-- Navbar fixa -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="pagina_inicial.php">Mesadinha</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
              <a class="nav-link" href="Pagina_inicial.php">Página Inicial </a>
            </li>
            
            <li class="nav-item">

              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Usuários
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <a class="dropdown-item" href="perfil.php">Perfil</a>
                  <a class="dropdown-item" href="senha.php">Alterar Senha</a>
                </div>
              </div>

            </li>
     
            <li class="nav-item">

              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Gerenciar Cadastros
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <a class="dropdown-item" href="categoria.php">Categoria</a>
                  <a class="dropdown-item" href="contas.php">Conta</a>
                </div>
              </div>

            </li>
          
            <li class="nav-item active">
                <a class="nav-link" href="lancamento.php">Lançamentos</a>
            </li>

          </ul>
          
          <a class="btn btn-danger" href="logout.php">Sair</a>
          
        </div>
      </nav>
    </header>

<body> 
<div class="frm">
<div class="container lista bordas">

<div class="row">
    <div class="col-lg-12">
    <div class="row">
    <div class="col-lg-11">
<h3>Lista de Usuários</h3>
		</div>
		<div class="col-lg-1">
			<a class="btn btn-outline-success" href="Cadastro.php"><i class="fa fa-plus"></i></a>
		</div>


    <div class="col-lg-12">
			<table class="table table-dark"> 
				<thead> 
					<tr>
					<th>Matrícula</th> 
					<th>Nome</th>
					<th>Endereco</th>
					<th>Telefone</th>
					<th></th> 
				</tr>
			</thead>
			<tbody> 
				<?php if($listausuarios) :
					foreach ($listausuarios as $usuario) : ?>
						<tr> 
							<td><?php echo $usuario->id_usuario; ?> </td>
							<td><?php echo $usuario->nome; ?> </td>
							<td><?php echo $usuario->endereco; ?> </td>		
							<td><?php echo $usuario->telefone; ?> </td>		
							<td> 

							<a href="cadastro.php?id_usuario=<?php echo $usuario->id_usuario;?>" class= "btn btn-outline-primary"><i class="fa fa-edit"></i></a>
              <a excluir href="perfil.php?id_usuario=<?php echo $usuario->id_usuario;?>" class= "btn btn-outline-danger"><i class="fa fa-trash"></i></a>

              
							</td>
							</tr>
							<?php endforeach; ?> 
							<?php else: ?>
							<tr>
							<td colspan="5">Nenhum usuário cadastrado!!!</td>
							</tr>
							<?php endif; ?>
							</tbody>
              </table>
    </div>
   
							</div>
							</div>
              </div>
</div>
</div>
              <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    document.querySelectorAll("a[excluir]").forEach(function(value)
    {
        value.addEventListener("click", function(event)
        {
            let confirmador = confirm("Deseja mesmo excluir o usuário?")
            if(!confirmador) event.preventDefault()
        })
    })
</script>
</body>
</html>