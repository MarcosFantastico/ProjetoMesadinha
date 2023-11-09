<?php 

//session_start();

require_once "Conexao.php";

class categoria
{

public $nome; 
public $id;
public $id_usuario;
public $id_categorias;
public $endereco;
public $telefone;
public $email;
public $senha;
public $cat;

public function listartodosC()
    {
        try {
            $bd = new conexao();

            $con = $bd->conectar();

            $sql = $con->prepare("SELECT * FROM cad_categorias");   
            
            $sql->execute();

           // var_dump($sql->rowCount());
            //die();
            if ($sql->rowCount() > 0) {
                 $result = $sql->fetchAll(PDO::FETCH_CLASS);
                return $result;
            } 
            else 
            {
                echo "Nenhuma categoria encontrada!";
            }
        } catch (PDOException $msg) {
            echo "Não foi possível conectar ao banco de dados categiria. {$msg->getMessage()}";
        }
    }
   
    public function inserirCat()
    {
        try {

            if (isset($_POST["categoria"])) 
            {
                $this->nome = $_POST["categoria"];
                $bd = new conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("INSERT into cad_categorias(usuario_id,nome) value(?,?)");
                $sql->execute(array(
                    $_SESSION["user"]->id_usuario,
                    $this->nome
                ));
                if ($sql->rowCount() > 0) 
                {
                    header("location: categoria.php");
                    
                } 
                else 
                {
                    var_dump($sql->errorInfo());
                }
            }
            else
            { 
               echo "<script>window.alert('Usuario ínvalido');window.location.href='./'</script>";
            } 

        } catch (PDOException $msg) {
            echo "Não foi possível inserir o aluno:" . $msg->getMessage();
        }
    }


    public function excluirCat($id_categorias)
    {
        try 
        {
            if(isset($id_categorias)) 
            {
                $this->id_categorias = $id_categorias;
                $bd = new conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("DELETE FROM cad_categorias where id_categorias=?");
                $sql->execute(array($this->id_categorias));
                //var_dump($sql->errorInfo());
                //var_dump($_SESSION);
                //die();
                if($sql->rowCount() > 0) 
                {
                   header("location: categoria.php");
                }
                else
                {
                    header("location: categoria.php");
                
                }
            }
        } 
        catch (PDOException $msg) 
        {
            echo "Não foi possível excluir a categoria. {$msg->getMessage()}";
        }
    }
}
?>