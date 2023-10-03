<?php

class Funcionario{
    
    private $id_funcionario;
    private $nome;
    private $sobrenome;
    private $salario;
    
    function getId_funcionario() {
        return $this->id_funcionario;
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getSalario(){
        return $this->salario;
    }

    function setId_funcionario($id_funcionario) {
        $this->id_funcionario = $id_funcionario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setSalario($salario){
        $this->salario = $salario;
    }

    
}

