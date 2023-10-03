<?php
/*
    Criação da classe Funcionario com o CRUD
*/
class Database{

    private static $instance;

    private static function getConexao() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;dbname=funcionariosdb', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
 
        return self::$instance;
    }
    
    public function create(Funcionario $funcionario) {
        try {
            $sql = "INSERT INTO funcionario (                   
                  nome,sobrenome,salario)
                  VALUES (
                  :nome,:sobrenome,:salario)";

            $p_sql = Database::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $funcionario->getNome());
            $p_sql->bindValue(":sobrenome", $funcionario->getSobrenome());
            $p_sql->bindValue(":salario", $funcionario->getSalario());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir funcionario <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM funcionario order by nome asc";
            $result = Database::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaFuncionarios($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Funcionario $funcionario) {
        try {
            $sql = "UPDATE funcionario set
                
                  nome=:nome,
                  sobrenome=:sobrenome,
                  salario=:salario                 
                                                                       
                  WHERE id_funcionario = :id_funcionario";
            $p_sql = Database::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $funcionario->getNome());
            $p_sql->bindValue(":sobrenome", $funcionario->getSobrenome());
            $p_sql->bindValue(":salario", $funcionario->getSalario());
            $p_sql->bindValue(":id_funcionario", $funcionario->getId_funcionario());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Funcionario $funcionario) {
        try {
            $sql = "DELETE FROM funcionario WHERE id_funcionario = :id_funcionario";
            $p_sql = Database::getConexao()->prepare($sql);
            $p_sql->bindValue(":id_funcionario", $funcionario->getId_funcionario());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir funcionario<br> $e <br>";
        }
    }

    private function listaFuncionarios($row) {
        $funcionario = new Funcionario();
        $funcionario->setId_funcionario($row['id_funcionario']);
        $funcionario->setNome($row['nome']);
        $funcionario->setSobrenome($row['sobrenome']);
        $funcionario->setSalario($row['salario']);

        return $funcionario;
    }
 }

 ?>
