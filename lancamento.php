<?php

require_once "Classes/contas.php";
$contas = new contas();
$listaContas = $contas->listartodosContas();


require_once "Classes/movimentacao.php";
$dinheiro = new dinheiro();

$receitas = $dinheiro->listarValores("Receita");
$despesas = $dinheiro->listarValores("Despesa");

$listaD = $dinheiro->listartodosD();

if (isset($_POST["Enviar"])) {
  $dinheiro->inserirD();
}
if (isset($_GET["excluir_movimentacao"])) {
  $dinheiro->excluir($_GET["excluir_movimentacao"]);
}

if (isset($_GET["alterar_movimentacao"])) {
  $dinheiro->alterar($_GET["alterar_movimentacao"]);
}

//var_dump($_POST["Enviar"]);
//die();
?>

<!DOCTYPE html>
<html lang="pt-br">

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
  <div class="frm">
    <div class="lista bordas">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">

            <div class="col-lg-4">
              <li class="list-group-item active">Receitas</li>
              <h1 style="color: green">R$<?php echo number_format($receitas, 0, ',', '.'); ?></h1>
            </div>
            <div class="col-lg-4">
              <li class="list-group-item active">Despesas</li>
              <h1 style="color: red">R$<?php echo number_format($despesas, 0, ',', '.');  ?></h1>
            </div>

            <div class="col-lg-4">
              <li class="list-group-item active">Saldo</li>
              <h1 style="color: orange">R$<?php echo number_format($receitas - $despesas, 0, ',', '.'); ?></h1>
            </div>
          </div>
        </div>

      </div>
    </div>
    <form action="lancamento.php" method="POST">
      <div class="container lista bordas">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="form-group col-lg-12">
                <li class="list-group-item active">Lançar Movimentação</li>
              </div>

              <div class="form-group col-lg-6">
                <label value="">Escolha a Conta:</label>
                <select class="form-control" id="cat" name="cat">
                  <?php if ($listaContas) {
                    foreach ($listaContas as $contas) { ?>
                      <option value="<?php echo $contas->id_contas ?>"><?php echo $contas->nome; ?></option>
                    <?php } ?>
                  <?php } else { ?>
                    <option value=0><?php echo "Nenhuma conta cadastrada!!!" ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-lg-6">
                <label for="senha">Valor</label>
                <input type="number" id="Depositar" name="Depositar" class="form-control" min="-100000" max="100000" required>
              </div>
            </div>
            <input type="submit" class="btn btn-outline-success" name="Enviar" value="Enviar">
            <a href="contas.php" class="btn btn-outline-danger">Voltar</a>
          </div>
        </div>
      </div>
    </form>
    <div class="lista bordas">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>Conta</th>
            <th>Valor</th>
            <th>Data</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($listaD) {
            foreach ($listaD as $dinheiro) { ?>
              <tr>
                <td><?php echo $dinheiro->nome ?> </td>
                <td><?php echo $dinheiro->valor ?> </td>
                <td><?php echo date('d/m/Y', strtotime($dinheiro->data_atual)) ?> </td>
                <td>
                  <a href="lancamento.php?alterar_movimentacao=<?php echo $dinheiro->id_movimentacao ?>" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                  <a excluir href="lancamento.php?excluir_movimentacao=<?php echo $dinheiro->id_movimentacao ?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <td> Nenhuma movimentação cadastrada!!! </td>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')
  </script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>