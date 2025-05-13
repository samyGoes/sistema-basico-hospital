<?php
require_once("../../../model/Especialidade.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <title>Cadastrar Médicos</title>
</head>

<body>
    <nav>
        <div id="nav-logo">Logo</div>
        <div id="nav-menu">
            <a href="../../../index.html">início</a>
            <a href="../opcoes-de-cadastro.html">cadastrar</a>
            <a href="../../agendar/form-agendar-consulta.php">agendar consulta</a>
            <a href="../../gestao-horario/gestao-horario.php">gestão de horários</a>
        </div>
        <a href="#" id="nav-login">Login</a>
    </nav>

    <section>
        <div id="card">
            <h1> Cadastrar Médicos </h1>
            <div id="form">
                <form action="../../../controller/controller-cadastrar-medicos.php" method="post">
                    <div id="campo">
                        <label for="nome">*Nome:</label><br>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div id="campo">
                        <label for="rg">*RG:</label><br>
                        <input type="text" id="rg" name="rg" required>
                    </div>
                    <div id="campo">
                        <label for="cpf">*CPF:</label><br>
                        <input type="text" id="cpf" name="cpf" required>
                    </div>
                    <div id="campo">
                        <label for="sexo">*Sexo:</label><br>
                        <select name="sexo" id="sexo">
                            <option value="0" disabled>Selecione...</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Intersexo">Intersexo</option>
                            <option value="Prefiro Não Informar">Prefiro Não Informar</option>
                        </select>
                    </div>
                    <div id="campo">
                        <label for="genero">*Gênero:</label><br>
                        <select name="genero" id="genero">
                            <option value="0" disabled>Selecione...</option>
                            <option value="Homem Cisgênero">Homem Cisgênero</option>
                            <option value="Mulher Cisgênero">Mulher Cisgênero</option>
                            <option value="Homem Trans">Homem Trans</option>
                            <option value="Mulher Trans">Mulher Trans</option>
                            <option value="Pessoa Não-Binária">Pessoa Não-Binária</option>
                            <option value="Outro">Outro</option>
                            <option value="Prefiro Não Informar">Prefiro Não Informar</option>
                        </select>
                    </div>
                    <div id="campo">
                        <label for="data-consulta">*Data De Nascimento:</label><br>
                        <input type="date" id="data-de-nascimento" name="data-de-nascimento" required>
                    </div>
                    <div id="campo">
                        <label for="cep">*CEP:</label><br>
                        <input type="text" id="cep" name="cep" onblur="pesquisa_cep(this.value);" required>
                    </div>
                    <div id="campo">
                        <label for="numero-logradouro">*Número Do Logradouro (Rua/Avenida):</label><br>
                        <input type="text" id="numero-logradouro" name="numero-logradouro" required>
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
                        <input type="text" id="crm" name="crm" required>
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
                                <option value="<?php echo $l["id_especialidade"]; ?>">
                                    <?php echo $l["desc_especialidade"]; ?>
                                </option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div id="campo">
                        <label for="telefone1">*Telefone 1:</label><br>
                        <input type="text" id="telefone1" name="telefone1" required>
                    </div>
                    <div id="campo">
                        <label for="telefone2">Telefone 2 (opcional):</label><br>
                        <input type="text" id="telefone2" name="telefone2">
                    </div>
                    <div id="campo">
                        <label for="nome-convenio">Nome Do Convênio:</label><br>
                        <input type="text" id="nome-convenio" name="nome-convenio">
                    </div>
                    <div id="campo">
                        <label for="carteirinha-convenio">N° Da Carteirinha Do Convênio:</label><br>
                        <input type="text" id="carteirinha-convenio" name="carteirinha-convenio">
                    </div>
                    <div id="campo">
                        <label for="email">*Email:</label><br>
                        <input type="text" id="email" name="email" required>
                    </div>
                    
                    <div id="campo" class="campo-btn">
                        <input type="submit" name="submit-consulta" value="CADASTRAR">
                            <a id="voltar" href="lista-de-medicos.php">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <?php
        if(isset($_GET["cadastro"]))
        {
            if($_GET["cadastro"] == "sucesso") 
            { 
                echo("<script> alert('Cadastro feito com sucesso!'); </script>"); 
            }
            else if($_GET["cadastro"] == "erro")
            { 
                echo("<script> alert('CPF inválido!'); </script>"); 
            }
        }
        
    ?>

    <script src="../../../assets/js/cep-auto.js"></script>
</body>

</html>