<?php
//session_start();

require_once "Conexao.php";

class dinheiro
{
    public $id_usuario;
    public $id_movimentacao;
    public $contas_id;
    public $valor;
    public $data_atual;
    public $colocado=0;
    public $tirar=0;
    public $saldo=0;
    
    public function inserirD()
    {   
        try {

            if(isset($_POST["Depositar"]) && $_POST["Depositar"]!="")
            {
                /*tem q somar os valores no banco*/ 
                    $valor = $_POST["Depositar"];

                   // $saldo += $valor;

                    $this->contas_id = $_POST["cat"];

                    $bd=new conexao();
                    $con=$bd->conectar();
                    $sql=$con->prepare("INSERT INTO movimentacao(id_movimentacao,valor,contas_id,usuario_id) values(null,?,?,?)");
                    $sql->execute(array(
                        $this->valor=$valor,
                        $this->contas_id,
                        $_SESSION["user"]->id_usuario
                    ));

                        //var_dump($_POST);
                        //var_dump($_SESSION);
                        // var_dump($_POST["Depositar"]);
                        //die();
                    if ($sql->rowCount() > 0) 
                    {

                    if(isset($_POST["Depositar"]) && $_POST["Depositar"]!="" && $_POST["Depositar"]>0)
                    {
                        echo "<script>window.alert('Depositado com Sucesso!');window.location.href='lancamento.php'</script>";
                    }
                    else if(isset($_POST["Depositar"]) && $_POST["Depositar"]!="" && $_POST["Depositar"]<0)
                    {
                        echo "<script>window.alert('Retirado com Sucesso!');window.location.href='lancamento.php'</script>";
                    }
                    else
                    {
                        echo "<script>window.alert('Insira um valor diferente de 0');window.location.href='lancamento.php'</script>";
                    }         
                    } 
                    else 
                    {
                        var_dump($sql->errorInfo());
                    }        
          
                }
                else
                {
                    header("location:lancamento.php ");
                }

            }catch (PDOException $msg) {
                echo "Não foi possível inserir o aluno:" . $msg->getMessage();
            }
            
    }
    
    
    public function listartodosD()
    {

        try {
            $bd = new conexao();

            $con = $bd->conectar();

            $sql = $con->prepare("SELECT * FROM movimentacao join cad_contas on movimentacao.contas_id = cad_contas.id_contas");   
            
            $sql->execute();

           // var_dump($sql->rowCount());
            //die();
            if ($sql->rowCount() > 0) {

                 $result = $sql->fetchAll(PDO::FETCH_CLASS);
                return $result;
               
            } else {
                echo "Nenhuma movimentacao encontrada!";
            }
        } catch (PDOException $msg) {
            echo "Não foi possível conectar ao banco de dados movimentacao. {$msg->getMessage()}";
        }
    }

    public function valor_receita()
    {
        try 
        {
            $bd = new conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("SELECT sum(m.valor) FROM movimentacao m join cad_contas c on m.contas_id = c.id_contas where c.tipo = 'Receita'");
            $sql->execute();


            // var_dump($sql->rowCount());
            //die();
            if ($sql->rowCount() > 0) 
            {
                $result = $sql->fetchAll(PDO::FETCH_CLASS);
                return $result;
            }

            else 
            {
                echo "Nenhuma movimentacao encontrada!";
            }
        } 
        catch (PDOException $msg) 
        {
            echo "Não foi possível conectar ao banco de dados movimentacao. {$msg->getMessage()}";
        }
    }

    public function valor_despesa()
    {
        try 
        {
            $bd = new conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("SELECT sum(m.valor) FROM movimentacao m join cad_contas c on m.contas_id = c.id_contas where c.tipo = 'Despesa'");
            $sql->execute();

            // var_dump($sql->rowCount());
            //die();
            if ($sql->rowCount() > 0) 
            {
                $result = $sql->fetchAll(PDO::FETCH_CLASS);
                return $result;
            }
            else 
            {
                echo "Nenhuma movimentacao encontrada!";
            }
        } 
        catch (PDOException $msg) 
        {
            echo "Não foi possível conectar ao banco de dados movimentacao. {$msg->getMessage()}";
        }
    }
    
    public function listarValores($tipoValor)
    {
        try
        {
            $bd = new conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("SELECT SUM(l.VALOR) AS VALOR FROM movimentacao l INNER JOIN cad_contas c ON l.contas_id = c.id_contas WHERE c.usuario_id = ? AND c.tipo = ?;");
            
            $sql->execute([$_SESSION["user"]->id_usuario, $tipoValor]);
            if($sql->rowCount() > 0)
            {
                return $sql->fetchAll(PDO::FETCH_NUM)[0][0] ?? 0;
            }
        }
        catch(PDOException $msg)
        {
            echo "erro {$msg->getMessage()}";
        }


    }

    public function excluir($id_movimentacao)
    {
        try {
            if (isset($id_movimentacao)) 
            {
                $this->id_movimentacao = $id_movimentacao;
                $bd = new conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("DELETE FROM movimentacao where id_movimentacao=?");
                $sql->execute(array($this->id_movimentacao));

                //var_dump($sql->errorInfo());
                //var_dump($_SESSION);
                //die();
                if($sql->rowCount() > 0) 
                {
                   header("location: lancamento.php");
                }
                else
                {
                    header("location: lancamento.php");
                }
            }
        } 
        catch (PDOException $msg) 
        {
            echo "Não foi possível excluir o Aluno. {$msg->getMessage()}";
        }
    }

    public function alterar()
    {
        try {
             // verificar se recebeu os valores do formulário
            if (isset($_GET["alterar_movimentacao"])) 
                {
                $this->id_movimentacao = $_GET["alterar_movimentacao"];
                $this->nome = $_POST["nome"];
                $this->sexo = $_POST["sexo"];
                $this->email = $_POST["email"];
                $this->endereco = $_POST["endereco"];
                $this->telefone = $_POST["telefone"];
                $this->senha = $_POST["senha"];
                //instanciar classe conexão
                $bd = new conexao();
                //criar objeto contendo a conexão
                $con = $bd->conectar();
                // comando para enviar ao bd passando parametros ?
                $sql = $con->prepare("UPDATE alunos set nome=?, sexo=?, 
                email=?, endereco=?, telefone=?, senha=? where matricula=?");
                //executar o comando passando os valores recebidos do formulário
                $sql->execute(array(
                    $this->nome,
                    $this->sexo,
                    $this->email,
                    $this->endereco,
                    $this->telefone,
                    $this->senha,
                    $this->matricula
                ));

                //testar se retornou os valores
                if ($sql->rowCount() > 0) 
                {
                    // se conseguiu gravar no banco retornar para index_alunos.php
                    header("location: index_alunos.php");
                } else 
                {
                    // se o usuário não preencheu os valores devolver para o index_alunos.php
                    header("location: index_alunos.php");
                    //var_dump($sql->errorInfo());
                }
            }
        } catch (PDOException $msg) {
            echo "Não foi possível alterar o aluno:" . $msg->getMessage();
        }
    }

}
?>
