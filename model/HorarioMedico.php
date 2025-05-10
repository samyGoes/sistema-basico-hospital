<?php

require_once("Conexao.php");
require_once("Pessoa.php");
require_once("Medico.php");

class HorarioMedico{

    private $id;
    private $horario;
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

    public function getMedico()
    {
        return $this->medico;
    }


    // OUTRAS FUNÇÕES
    public function cadastrar()
    {
        $conexao = Conexao::conexao();
        $queryInsert = $conexao->prepare(
            "INSERT INTO tb_horariosMedico(horario_hm, id_medico) VALUES (?, ?)"
        );
        $queryInsert->bindValue(1, $this->getHorario());
        $queryInsert->bindValue(2, $this->getMedico()->getId());
        $queryInsert->execute();

        return "Cadastro realizado com sucesso";
    }

    public function listar($id)
    {
        $conexao = Conexao::conexao();
        $querySelect = $conexao->query(
            "SELECT horario_hm FROM tb_horariosMedico WHERE id_medico = :id"
        );
        $querySelect->bindParam(":id", $id, PDO::PARAM_STR);
        $lista = $querySelect->fetchAll();
        return $lista;
    }

}

?>