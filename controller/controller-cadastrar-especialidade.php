<?php

require_once("../model/Especialidade.php");

try
{   
    $especialidade = new Especialidade();
    $especialidade->setDesc($_POST["nome-especialidade"]);
    $resposta = $especialidade->cadastrar();

    if($resposta == false)
    {
        throw new Exception("Falha no método cadastrar()");
    }
    else
    {
        header("Location: ../view/cadastrar/cadastrar-especialidade.php?cadastro=sucesso");
    }
}
catch(Exception $e)
{
    echo($e);
    header("Location: ../view/cadastrar/cadastrar-especialidade.php?cadastro=erro");
}

?>