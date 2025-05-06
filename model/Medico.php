<?php

require_once("Conexao.php");
require_once("Especialidade.php");

class Medico extends Pessoa{

    private $id;
    private $matricula;
    private $crm;
    private $dataAdmissao;
    private $dataDemissao;
    private $especialidade;

    public function __construct(){
        new Pessoa();
        $especialidade = new Especialidade();
    }

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    public function setCrm($crm)
    {
        $this->crm = $crm;
    }

    public function setDataAdmissao($dataAdmissao)
    {
        $this->dataAdmissao = $dataAdmissao;
    }

    public function setDataDemissao($dataDemissao)
    {
        $this->dataDemissao = $dataDemissao;
    }

    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getMatricula()
    {
        return $this->matricula;
    }

    public function getCrm()
    {
        return $this->crm;
    }

    public function getDataAdmissao()
    {
        return $this->dataAdmissao;
    }

    public function getDataDemissao()
    {
        return $this->dataDemissao;
    }

    public function getEspecialidade()
    {
        return $this->especialidade;
    }


    // OUTRAS FUNÇÕES
    public function cadastrar()
    {
        $conexao = Conexao::conexao();
        // CADASTRANDO DADOS NA TABELA PESSOA
        $queryInsertPessoa = $conexao->prepare(
            "INSERT INTO tb_pessoa(nome_pessoa) VALUES (?)"
        );
        
        $queryInsertPessoa->bindValue(1, parent::getNome());
        $queryInsertPessoa->execute();


        // PUXANDO O ID DO ÚLTIMO REGISTRO DE PESSOA E ATRIBUINDO AO ATRIBUTO ID
        $querySelect = $conexao->query(
            "SELECT LAST_INSERT_ID() FROM tb_pessoa"
        );
        $ultimoID = $querySelect->fetchColumn();
        //print_r($ultimoID);
        parent::setId($ultimoID);
        

        // CADASTRANDO DADOS NA TABELA MÉDICO
        $queryInsertMedico = $conexao->prepare(
            "INSERT INTO tb_medico(crm_medico, id_pessoa, id_especialidade) VALUES (?, ?, ?)"
        );
        $queryInsertMedico->bindValue(1, $this->getCrm());
        $queryInsertMedico->bindValue(2, parent::getId());
        $queryInsertMedico->bindValue(3, $this->getEspecialidade()->getId());
        $queryInsertMedico->execute();
        
    }

}

?>