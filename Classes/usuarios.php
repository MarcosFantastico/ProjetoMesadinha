<?php
//session_start();

require_once "Conexao.php";

class usuarios
{
    public $id_usuario;
    public $nome;
    public $endereco;
    public $telefone;
    public $email;
    public $senha;
    public $cat;
    public $delet;



    public function login(){
        try{
            if(isset($_POST["email"]) && isset($_POST["senha"])){
                $this->email = $_POST["email"];
                $this->senha = $_POST["senha"];

                $bd = new conexao();

                $con = $bd->conectar();
                $sql = $con->prepare("select * from usuario where email=? and senha=?");
                $sql->execute(array($this->email,$this->senha));

                if($sql->rowCount() > 0){
                    $_SESSION["user"]= $sql->fetchObject();
                    header("location:index.php");
                    
                }else{
                    header("location:index.php");
                }
        }
    }
    catch (PDOException $msg) {
        echo "Nao foi possivel fazer o login . {$msg->getMessage()}";
    }
    }
  

    public function inserir()
    {
        try {


            if (isset($_POST["nome"]) && isset($_POST["endereco"]) && isset($_POST["telefone"]) && isset($_POST["email"]) && isset($_POST["senha"])) 
            {
                $this->nome = $_POST["nome"];
                $this->endereco = $_POST["endereco"];
                $this->telefone = $_POST["telefone"];
                $this->email = $_POST["email"];
                $this->senha = $_POST["senha"];
                

                $bd=new conexao();
                $con=$bd->conectar();
                $sql=$con->prepare("INSERT INTO usuario(id_usuario,nome,endereco,telefone,email,senha) values (null,?,?,?,?,?)");
                $sql->execute(array(
                
                    $this->nome,
                    $this->endereco,
                    $this->telefone,
                    $this->email,
                    $this->senha
                ));
                if ($sql->rowCount() > 0) 
                {
                    header("location: index.php");
                } 
                else 
                {
                    var_dump($sql->errorInfo());
                }
            }
        } catch (PDOException $msg) {
            echo "Não foi possível inserir o aluno:" . $msg->getMessage();
        }
    }

    public function validaraluno($email,$senha)
    {
        try{
                $bd = new conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("SELECT * from usuario where email=? and senha=?");
                $sql->execute(array(
                    $email,
                    $senha    
                ));
                $row = $sql->fetchObject();
                if($row)
                {
                    $_SESSION["user"] = $row;
                    header("location: ./Pagina_Inicial.php"); // ../-> Subir um nível de pasta -> voltar pro index  ./-> Aponta para o próprio local
                }
                else
                { 
                   echo "<script>window.alert('Usuario ínvalido');window.location.href='./'</script>";
                }          

            }
            catch(PDOException $msg)
            {
                echo "Login inválido".$msg->getMessage();
            }
    }



   public function listartodos()
    {

        try {
            $bd = new conexao();

            $con = $bd->conectar();

            $sql = $con->prepare("SELECT * FROM usuario");

            $sql->execute();

           // var_dump($sql->rowCount());
            //die();
            if ($sql->rowCount() > 0) {

                 $result = $sql->fetchAll(PDO::FETCH_CLASS);
                return $result;
               
            } else {
                echo "Nenhum aluno cadastrado";
            }
        } catch (PDOException $msg) {
            echo "Não foi possível conectar ao banco de dados Alunos. {$msg->getMessage()}";
        }
    }

    public function listarUsuario($id_usuario)
    {

        try {

            $this->id_usuario = $id_usuario;

            $bd = new conexao();

            $con = $bd->conectar();

            $sql = $con->prepare("SELECT * FROM usuario WHERE id_usuario = ?");

            $sql->execute(array($this->id_usuario));

            if ($sql->rowCount() > 0) {

                 $result = $sql->fetchAll(PDO::FETCH_CLASS);
                return $result;
               
            } else {
                echo "Nenhum aluno cadastrado";
            }
        } catch (PDOException $msg) {
            echo "Não foi possível conectar ao banco de dados Alunos. {$msg->getMessage()}";
        }
    }
   

    public function alterar()
    {
        try {
             // verificar se recebeu os valores do formulário
            if (isset($_POST["alterar"])) {
                $this->id_usuario = $_SESSION["user"]->id_usuario;
                $this->nome = $_POST["nome"];
                $this->email = $_POST["email"];
                $this->endereco = $_POST["endereco"];
                $this->telefone = $_POST["telefone"];
                $this->senha = $_POST["senha"];
                $bd=new conexao();
                $con=$bd->conectar();
                $sql=$con->prepare("UPDATE usuario set nome=?,
                email=?,endereco=?,telefone=?,senha=? where id_usuario=?");
                $sql->execute(array(
                    $this->nome,
                    $this->email,
                    $this->endereco,
                    $this->telefone,
                    $this->senha,
                    $this->id_usuario
                ));

                if ($sql->rowCount() > 0) 
                {
                    header("location: pagina_inicial.php");
                } else 
                {
                    header("location: pagina_inicial.php");
                }
                
            }
        } 
        catch (PDOException $msg) {
            echo "Não foi possível alterar o aluno:" . $msg->getMessage();
        }
    }
    public function listarid($id_usuario)
    {
        try {
            if (isset($id_usuario)) 
            {
                $this->id_usuario = $id_usuario;
                $bd = new conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("SELECT * FROM usuario where id_usuario=?");
                $sql->execute(array($this->id_usuario));
                if($sql->rowCount() > 0) 
                {
                    return $result = $sql->fetchObject();
                }
            }
        } 
        catch (PDOException $msg) 
        {
            echo "Não foi possível conectar ao banco de dados Alunos. {$msg->getMessage()}";
        }
    }

    public function excluir($id_usuario)
    {
        try {
            if (isset($id_usuario)) 
            {
                $this->id_usuario = $id_usuario;
                $bd = new conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("DELETE FROM usuario where id_usuario=?");
                $sql->execute(array($this->id_usuario));

                //var_dump($sql->errorInfo());
                //var_dump($_SESSION);
                //die();
                if($sql->rowCount() > 0) 
                {
                    if($_SESSION['user']->id_usuario == $id_usuario)
                    {
                        header("location:logout.php");
                    }
                }
                else
                {
                    header("location: perfil.php");
                }
            }
        } 
        catch (PDOException $msg) 
        {
            echo "Não foi possível excluir o Aluno. {$msg->getMessage()}";
        }
    }

}


/*teste classe

//importar o arquivo conexão

include -> importar um arquivo / da mensagem de erro / continuar a execução do código (utilizado para incluir comandos html/php)
require -> importar um arquivo / da mensagem de erro / para a execução do código (utilizado para incluir classes php)
include_once / require_once -> once significa importar uma única vez
require_once "Conexao.php";

//criar uma instância da classe -> utilizar o new para criar um objeto do tipo classe

$bd = new conexao();

// criar uma variável para receber a conexão

$con = $bd -> conectar();



*/
?>
