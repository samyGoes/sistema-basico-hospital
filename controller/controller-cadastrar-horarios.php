<?php

require_once("../model/HorarioMedico.php");
require_once("../model/Pessoa.php");

try
{
    $horarioMedico = new HorarioMedico();
    $medico = new Medico();

    $horarioMedico->setHorario($_POST["horario"]);
    $horarioMedico->setData($_POST["data"]);

    $id = $_POST["id"];
    $medico->setId($_POST["id"]);
    $horarioMedico->setMedico($medico);

    $resposta = $horarioMedico->cadastrar();

    if($resposta == false)
    {
        throw new Exception("Falha no método cadastrar()");
    }
    else
    {
        header("Location: ../view/cadastrar/medicos/gestao-horario/cadastrar-horarios.php?cadastro=sucesso/id-medico=$id");
    }
}
catch(Exception $e)
{
    header("Location: ../view/cadastrar/medicos/gestao-horario/cadastrar-horarios.php?cadastro=erro");
}

?>