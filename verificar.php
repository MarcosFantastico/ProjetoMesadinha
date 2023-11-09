<?php 
$saldo=0;
$colocado=0;
$tirar=0;



if(isset($_POST["Depositar"])&& $_POST["Depositar"]!="" && $_POST["Depositar"]!=0)
{

  $colocado=$_POST["Depositar"];
  echo "<script>window.alert('Depositado com Sucesso!');window.location.href='Pagina_inicial.php'</script>";

}  
  else{ 
          if(isset($_POST["tirar"])&& $_POST["tirar"]!="" && $_POST["tirar"]!=0)
          {
            $tirar=$_POST["tirar"];
            echo "<script>window.alert('Retirado com Sucesso!');window.location.href='Pagina_inicial.php'</script>"; 
          }

          else
          { 
            echo "<script>window.alert('Nenhum valor Digitado');window.location.href='Pagina_inicial.php'</script>";
          }   
      }


?>
