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
        if($this->validarData($this->getData()) == true)
        {
            $conexao = Conexao::conexao();
            $queryInsert = $conexao->prepare(
                "INSERT INTO tb_horariosMedico(horario_hm, data_hm, id_medico) VALUES (?, ?, ?)"
            );
            $queryInsert->bindValue(1, $this->getHorario());
            $queryInsert->bindValue(2, $this->getData());
            $queryInsert->bindValue(3, $this->getMedico()->getId());
            $queryInsert->execute();

            return true;
        }
        return false;
    }

    public function listar($id)
    {
        $conexao = Conexao::conexao();

        $querySelect = $conexao->prepare(
            "SELECT tb_horariosMedico.horario_hm, tb_horariosMedico.data_hm
             FROM tb_horariosMedico, tb_medico
             WHERE tb_horariosMedico.id_medico = tb_medico.id_medico
                AND tb_medico.id_medico = :id"
        );
        $querySelect->bindParam(":id", $id, PDO::PARAM_STR);
        $querySelect->execute();
        $lista = $querySelect->fetchAll();

        return $lista;       
    }

    public function validarData($data)
    {
        $ano = substr($data, 0, 4);

        date_default_timezone_set('America/Sao_Paulo');
        $ano_atual = substr(date("Y-m-d"), 0, 4);

        if($ano >= $ano_atual)
        { return true; }
        else
        { return false; }
    }
}

?>