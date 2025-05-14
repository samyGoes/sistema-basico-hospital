<?php

require_once("../model/Pessoa.php");
require_once("../model/Medico.php");

try
{
    $medico = new Medico();
    $medico->setStatus("desativado");
    $medico->setId($_POST["id-medico-desativar"]);

    $respota = $medico->desativar();

    if ($resposta == false) {
        throw new Exception("Falha no método cadastrar()");
    }
    else
    {
        header("Location: ../view/cadastrar/medicos/lista-de-medicos.php?desativacao=sucesso");
    } 
    exit();
}
catch(Exception $e)
{
    echo("<prev>");
    echo($e);
    echo("</prev>");

    header("Location: ../view/cadastrar/medicos/lista-de-medicos.php?desativacao=erro");
}

?>