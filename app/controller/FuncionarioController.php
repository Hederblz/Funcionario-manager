<?php
include_once "../model/Funcionario.php";
include_once "../Database/Database.php";

//instancia as classes
$funcionario = new Funcionario();
$database = new Database();

//pega todos os dados passado por POST

$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

    $funcionario->setNome($d['nome']);
    $funcionario->setSobrenome($d['sobrenome']);
    $funcionario->setSalario($d['salario']);

    $database->create($funcionario);

    header("Location: ../../");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

    $funcionario->setNome($d['nome']);
    $funcionario->setSobrenome($d['sobrenome']);
    $funcionario->setSalario($d['salario']);
    $funcionario->setId_funcionario($d['id_funcionario']);

    $database->update($funcionario);

    header("Location: ../../");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

    $funcionario->setId_funcionario($_GET['del']);

    $database->delete($funcionario);

    header("Location: ../../");
}else{
    header("Location: ../../");
}
