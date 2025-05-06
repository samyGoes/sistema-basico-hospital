<?php

require_once("../model/Pessoa.php");
require_once("../model/Medico.php");

$medico = new Medico();
$especialidade = new Especialidade();

$medico->setNome($_POST["nome"]);
$medico->setCrm($_POST["crm"]);

$especialidade->setId($_POST["especialidade"]);
$medico->setEspecialidade($especialidade);

$medico->cadastrar();


?>