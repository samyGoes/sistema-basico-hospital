<?php

require_once("../model/HorarioMedico.php");
require_once("../model/Pessoa.php");

try
{
    $horarioMedico = new HorarioMedico();
    $medico = new Medico();

    $horarioMedico->setHorario($_POST["horario"]);
    $medico->setId($_POST["medico"]);
    $horarioMedico->setMedico($medico);

    $resposta = $horarioMedico->cadastrar();

    if($resposta == false)
    {
        throw new Exception("Falha no método cadastrar()");
    }
    else
    {
        header("Location: ../view/cadastrar/cadastrar-horarios.php?cadastro=sucesso");
    }
}
catch(Exception $e)
{
    header("Location: ../view/cadastrar/cadastrar-horarios.php?cadastro=erro");
}

?>