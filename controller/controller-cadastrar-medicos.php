<?php

require_once("../model/Pessoa.php");
require_once("../model/Medico.php");

try
{
    $medico = new Medico();
    $especialidade = new Especialidade();

    $medico->setNome($_POST["nome"]);
    $medico->setRg($_POST["rg"]);
    $medico->setCpf($_POST["cpf"]);
    $medico->setSexo($_POST["sexo"]);
    $medico->setGenero($_POST["genero"]);

    // Convertendo data para o padrão americano
    $data = strtotime($_POST["data-de-nascimento"]);
    $dataConvertida = date("Y-m-d", $data);
    //echo("Data convertida: " . $dataConvertida);

    $medico->setDataNasc($dataConvertida);
    $medico->setCep($_POST["cep"]);
    $medico->setNumLog($_POST["numero-logradouro"]);
    $medico->setLogradouro($_POST["nome-logradouro"]);
    $medico->setBairro($_POST["bairro"]);
    $medico->setCidade($_POST["cidade"]);
    $medico->setEstado($_POST["estado"]);
    $medico->setCrm($_POST["crm"]);

    $especialidade->setId($_POST["especialidade"]);
    $medico->setEspecialidade($especialidade);

    $medico->setTelefone1($_POST["telefone1"]);
    $medico->setTelefone2($_POST["telefone2"]);

    $medico->setNomeConvenio($_POST["nome-convenio"]);
    $medico->setNumCarteiraConvenio($_POST["carteirinha-convenio"]);
    $medico->setEmail($_POST["email"]);
    $medico->setSenha($_POST["senha"]);
    
    $resposta = $medico->cadastrar();

    if ($resposta == false) {
        throw new Exception("Falha no método cadastrar()");
    }
    else
    {
        header("Location: ../view/cadastrar/cadastrar-medicos.php?cadastro=sucesso");
    } 
    exit();
}
catch(Exception $e)
{ 
    echo("<pre>");
    echo($e);
    echo("</pre>");

    header("Location: ../view/cadastrar/cadastrar-medicos.php?cadastro=erro");
    exit();
}

?>