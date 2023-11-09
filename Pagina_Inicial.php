<?php

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
      <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body class="d-flex flex-column h-100">

    <header>
      <!-- Navbar fixa -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="Pagina_inicial.php">Mesadinha</a>
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
                  <a class="dropdown-item" href="senha.php">Alterar Dados</a>
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
          
          <a class="btn btn-danger" href="Index.php">Sair</a>
          
        </div>
      </nav>
    </header>


      
        


<body>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>