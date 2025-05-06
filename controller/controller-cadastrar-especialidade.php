<?php

require_once("../model/Especialidade.php");

$especialidade = new Especialidade();
$especialidade->setDesc($_POST["desc"]);
$especialidade->cadastrar();

?>