<?php
 //session_start();

require_once "Conexao.php";


class contas
{
    public $nome; 
    public $id_contas;
    public $categoria_id;
    public $id_usuario=0;
    public $tipo;
    public $cat ;



    public function listartodosContas()
    {

        try {
            $bd = new conexao();

            $con = $bd->conectar();

            $sql = $con->prepare("SELECT * FROM cad_contas");   
            
            $sql->execute();

           // var_dump($sql->rowCount());
            //die();
            if ($sql->rowCount() > 0) {

                 $result = $sql->fetchAll(PDO::FETCH_CLASS);
                return $result;
               
            } else {
                echo "Nenhuma categoria encontrada!";
            }
        } catch (PDOException $msg) {
            echo "Não foi possível conectar ao banco de dados categiria. {$msg->getMessage()}";
        }
    }
public function inserirCont()
{
    try {

        if (isset($_POST["NameC"])) 
        {
           
            $this->nome = $_POST["NameC"];
            $this->tipo =$_POST["tipoG"];
            $this->categoria_id =$_POST["cat"];
            $_SESSION["user2"]=$this->categoria_id;
            $bd = new conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("INSERT into cad_contas(usuario_id,nome,tipo,categoria_id) value(?,?,?,?)");
            $sql->execute(array(
                $_SESSION["user"]->id_usuario,
                $this->nome,
                $this->tipo,
                $this->categoria_id
            ));
            
           // var_dump($sql->rowCount());
           // die();
            
            if ($sql->rowCount() > 0) 
            {
                header("location: contas.php");
                
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

public function excluirCont($id_contas)
    {
        try {
            if (isset($id_contas)) 
            {
                $this->id_contas = $id_contas;
                $bd = new conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("DELETE FROM cad_contas where id_contas=?");
                $sql->execute(array($this->id_contas));

                //var_dump($sql->errorInfo());
                //var_dump($_SESSION);
                //die();
                if($sql->rowCount() > 0) 
                {
                    {
                        header("location:contas.php");
                    }
                }
                else
                {
                    header("location: contas.php");
                }
            }
        } 
        catch (PDOException $msg) 
        {
            echo "Não foi possível excluir o Aluno. {$msg->getMessage()}";
        }
    }
}
?>