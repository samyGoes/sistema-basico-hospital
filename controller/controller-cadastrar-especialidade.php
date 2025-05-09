<?php

require_once("../model/Especialidade.php");

try
{
    header("Location: ../view/cadastrar/cadastrar-especialidade.php?cadastro=sucesso");
    
    $especialidade = new Especialidade();
    $especialidade->setDesc($_POST["nome-especialidade"]);
    $especialidade->cadastrar();
}
catch(Exception $e)
{
    echo($e);
}

?>