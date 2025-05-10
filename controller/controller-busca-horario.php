<?php

require_once("../model/Pessoa.php");
require_once("../model/Medico.php");
require_once("../model/HorarioMedico.php");

$medico = new Medico();
$horario = new HorarioMedico();

$medico->setId($_POST["medico"]);
$horario->setMedico($medico);

header("Location: ../view/gestao-horario/gestao-horario.php");

?>