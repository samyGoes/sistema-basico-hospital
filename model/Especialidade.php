<?php

require_once("Conexao.php");

class Especialidade{

    private $id;
    private $desc;

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getDesc()
    {
        return $this->desc;
    }


    // OUTRAS FUNÇÕES
    public function cadastrar()
    {
        $conexao = Conexao::conexao();
        $queryInsert = $conexao->prepare(
            "INSERT INTO tb_especialidade(desc_especialidade) VALUES (?)"
        );
        $queryInsert->bindValue(1, $this->getDesc());
        $queryInsert->execute();

        return "Cadastro realizado com sucesso";
    }

    public function listar()
    {
        $conexao = Conexao::conexao();
        $querySelect = $conexao->query(
            "SELECT id_especialidade, desc_especialidade FROM tb_especialidade"
        );
        $lista = $querySelect->fetchAll();
        return $lista;
    }

}

?>