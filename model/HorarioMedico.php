<?php

require_once("Conexao.php");
require_once("Pessoa.php");
require_once("Medico.php");

class HorarioMedico{

    private $id;
    private $horario;
    private $data;
    private $medico;

    public function __construct(){
        $medico = new Medico();
    }

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setHorario($horario)
    {
        $this->horario = $horario;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setMedico($medico)
    {
        $this->medico = $medico;
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMedico()
    {
        return $this->medico;
    }


    // OUTRAS FUNÇÕES
    public function cadastrar()
    {
        $conexao = Conexao::conexao();
        $queryInsert = $conexao->prepare(
            "INSERT INTO tb_horariosMedico(horario_hm, data_hm, id_medico) VALUES (?, ?, ?)"
        );
        $queryInsert->bindValue(1, $this->getHorario());
        $queryInsert->bindValue(2, $this->getData());
        $queryInsert->bindValue(3, $this->getMedico()->getId());
        $queryInsert->execute();

        return "Cadastro realizado com sucesso";
    }

    public function listar($id)
    {
        $conexao = Conexao::conexao();

        $querySelect = $conexao->prepare(
            "SELECT horario_hm, data_hm FROM tb_horariosMedico WHERE id_medico = :id"
        );
        $querySelect->bindParam(":id", $id, PDO::PARAM_STR);
        $querySelect->execute();
        $lista = $querySelect->fetchAll();
        //print_r($lista);
        return $lista;
    }

}

?>