<?php

session_start();
$_SESSION["id-medico"] = $_POST["id-medico-horario"];
header("Location: ../view/cadastrar/medicos/gestao-horario/gestao-horario.php");
exit();

?>