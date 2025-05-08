<?php

require_once("../model/Pessoa.php");
require_once("../model/Medico.php");

$medico = new Medico();
$especialidade = new Especialidade();

$medico->setNome($_POST["nome"]);
$medico->setRg($_POST["rg"]);
$medico->setCpf($_POST["cpf"]);
$medico->setSexo($_POST["sexo"]);
$medico->setGenero($_POST["genero"]);
$medico->setDataNasc($_POST["dataNasc"]);
$medico->setCep($_POST["cep"]);
$medico->setNumLog($_POST["numLog"]);
$medico->setLogradouro($_POST["logradouro"]);
$medico->setBairro($_POST["bairro"]);
$medico->setCidade($_POST["cidade"]);
$medico->setEstado($_POST["estado"]);
$medico->setCrm($_POST["crm"]);

$especialidade->setId($_POST["especialidade"]);
$medico->setEspecialidade($especialidade);

$medico->setTelefone1($_POST["telefone1"]);
$medico->setTelefone2($_POST["telefone2"]);

$medico->setNomeConvenio($_POST["nomeConvenio"]);
$medico->setNumCarteiraConvenio($_POST["numConvenio"]);
$medico->setEmail($_POST["email"]);
$medico->setSenha($_POST["senha"]);

$medico->cadastrar();


?>