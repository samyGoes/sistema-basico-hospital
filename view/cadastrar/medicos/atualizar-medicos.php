<?php
require_once("../../../model/Pessoa.php");
require_once("../../../model/Medico.php");
require_once("../../../model/Especialidade.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <title>Atualizar dados</title>
</head>

<body>
    <nav>
        <div id="nav-logo">Logo</div>
        <div id="nav-menu">
            <a href="../../index.html">início</a>
            <a href="opcoes-de-cadastro.html">cadastrar</a>
            <a href="../agendar/form-agendar-consulta.php">agendar consulta</a>
            <a href="../gestao-horario/gestao-horario.php">gestão de horários</a>
        </div>
        <a href="#" id="nav-login">Login</a>
    </nav>

    <section>
        <div id="card">
            <h1> Atualizar dados </h1>
            <div id="form">
                <form action="../../../controller/controller-atualizar-medicos.php" method="post">
                <?php
                    $medico = new Medico();
                    $id_medico = $_POST["id"];
                    $lista_por_id = $medico->listar_por_id($id_medico);
                    
                    $sexo_cadastrado = $lista_por_id[0]["sexo_pessoa"];
                    $sexo_opcoes = ["Masculino", "Feminino", "Intersexo"];

                    $genero_cadastrado = $lista_por_id[0]["genero_pessoa"];
                    $genero_opcoes = ["Cisgênero", "Homem Trans", "Mulher Trans", "Não-binário", "Outro"] ;

                    $especialidade_cadastrada = $lista_por_id[0]["id_especialidade"];
                ?>

                    <div id="campo">
                        <label for="nome">*Nome:</label><br>
                        <input type="text" id="nome" name="nome" value="<?php echo($lista_por_id[0]["nome_pessoa"]); ?>" required>
                    </div>
                    <div id="campo">
                        <label for="rg">*RG:</label><br>
                        <input type="text" id="rg" name="rg" value="<?php echo($lista_por_id[0]["rg_pessoa"]); ?>" required>
                    </div>
                    <div id="campo">
                        <label for="cpf">*CPF:</label><br>
                        <input type="text" id="cpf" name="cpf" value="<?php echo($lista_por_id[0]["cpf_pessoa"]); ?>" readonly>
                    </div>
                    <div id="campo">
                        <label for="sexo">*Sexo:</label><br>
                        <select name="sexo" id="sexo">
                            <option value="0" disabled>Selecione...</option>
                        <?php
                            foreach($sexo_opcoes as $opcoes)
                            {
                        ?>
                                <option value="<?php echo($opcoes) ?>" <?php echo ($sexo_cadastrado == $opcoes) ? "selected" : ""; ?> > 
                                    <?php echo($opcoes) ?>
                                </option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div id="campo">
                        <label for="genero">*Gênero:</label><br>
                        <select name="genero" id="genero">
                            <option value="0" disabled>Selecione...</option>
                        <?php
                            foreach($genero_opcoes as $opcoes)
                            {
                        ?>
                                <option value="<?php echo($opcoes) ?>" <?php echo ($genero_cadastrado == $opcoes) ? "selected" : ""; ?> > 
                                    <?php echo($opcoes) ?>
                                </option>
                        <?php
                            }
                        ?>        
                        </select>
                    </div>
                    <div id="campo">
                        <label for="data-consulta">*Data De Nascimento:</label><br>
                        <input type="date" id="data-de-nascimento" name="data-de-nascimento" value="<?php echo($lista_por_id[0]["data_nasc_pessoa"]); ?>" readonly>
                    </div>
                    <div id="campo">
                        <label for="cep">*CEP:</label><br>
                        <input type="text" id="cep" name="cep" onblur="pesquisa_cep(this.value);" value="<?php echo($lista_por_id[0]["cep_pessoa"]); ?>" required>
                    </div>
                    <div id="campo">
                        <label for="numero-logradouro">*Número Do Logradouro (Rua/Avenida):</label><br>
                        <input type="text" id="numero-logradouro" name="numero-logradouro" value="<?php echo($lista_por_id[0]["num_log_pessoa"]); ?>" required>
                    </div>
                    <div id="campo">
                        <label for="nome-logradouro">*Nome Logradouro (Rua/Avenida):</label><br>
                        <input type="text" id="nome-logradouro" name="nome-logradouro" readonly>
                    </div>
                    <div id="campo">
                        <label for="bairro">*Bairro:</label><br>
                        <input type="text" id="bairro" name="bairro" readonly>
                    </div>
                    <div id="campo">
                        <label for="ciade">*Cidade:</label><br>
                        <input type="text" id="cidade" name="cidade" readonly>
                    </div>
                    <div id="campo">
                        <label for="estado">*Estado:</label><br>
                        <input type="text" id="estado" name="estado" readonly>
                    </div>
                    <div id="campo">
                        <label for="crm">*CRM:</label><br>
                        <input type="text" id="crm" name="crm" value="<?php echo($lista_por_id[0]["crm_medico"]); ?>" required>
                    </div>
                    <div id="campo">
                        <label for="especialidade">*Selecione Uma Especialidade:</label><br>
                        <select name="especialidade" id="especialidade">
                        <?php
                            $especialidade = new Especialidade();
                            $lista = $especialidade->listar();
                        
                            foreach($lista as $l)
                            {
                        ?>
                                <option value="<?php echo $l["id_especialidade"]; ?>" <?php echo ($especialidade_cadastrada == $l["id_especialidade"]) ? "selected" : ""; ?> >
                                    <?php echo $l["desc_especialidade"]; ?>
                                </option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div id="campo">
                        <label for="telefone1">*Telefone 1:</label><br>
                        <input type="text" id="telefone1" name="telefone1" value="<?php echo($lista_por_id[0]["num_telefone"]); ?>" required>
                    </div>
                    <div id="campo">
                        <label for="telefone2">Telefone 2 (opcional):</label><br>
                        <input type="text" id="telefone2" name="telefone2" value="<?php if(count($lista_por_id) > 1) {echo($lista_por_id[1]["num_telefone"]);} ?>">
                    </div>
                    <div id="campo">
                        <label for="nome-convenio">Nome Do Convênio:</label><br>
                        <input type="text" id="nome-convenio" name="nome-convenio" value="<?php echo($lista_por_id[0]["nome_convenio_pessoa"]); ?>">
                    </div>
                    <div id="campo">
                        <label for="carteirinha-convenio">N° Da Carteirinha Do Convênio:</label><br>
                        <input type="text" id="carteirinha-convenio" name="carteirinha-convenio" value="<?php echo($lista_por_id[0]["numero_convenio_pessoa"]); ?>">
                    </div>
                    <div id="campo">
                        <label for="email">*Email:</label><br>
                        <input type="text" id="email" name="email" value="<?php echo($lista_por_id[0]["email_pessoa"]); ?>" required>
                    </div>
                    
                    <div id="campo" class="campo-btn">
                        <input type="hidden" id="id" name="id" value="<?php echo($id_medico); ?>">
                        <input type="submit" value="ATUALIZAR">
                            <a id="voltar" href="lista-de-medicos.php">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <?php
        if(isset($_GET["atualizacao"]))
        {
            if($_GET["atualizacao"] == "erro")
            { 
                echo("<script> alert('Erro ao atualizar!'); </script>"); 
            }
        }
        
    ?>

    <script src="../../../assets/js/cep-auto.js"></script>
</body>

</html>