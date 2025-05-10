<?php
require_once("../../model/Pessoa.php");
require_once("../../model/Medico.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/style-horarios.css">
        <title> Agendar Consulta</title>
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
                <h1> Cadastrar Horários dos Médicos </h1>
                <div id="form">
                    <form action="../../controller/controller-cadastrar-horarios.php" method="post">
                        <div id="campo" class="campo-especialidade">
                            <label for="nome-especialidade">*Médico:</label>
                            <select name="medico" id="medico" required>
                                <option value="0" disabled>Selecione...</option>
                            <?php
                                $medico = new Medico();
                                $lista = $medico->listar();
                                foreach($lista as $l)
                                {
                            ?>
                                    <option value="<?php echo($l["id_medico"]); ?>"> 
                                        <?php echo($l["nome_pessoa"]); ?>
                                    </option>
                            <?php
                                }
                            ?>
                            </select>                     
                        </div> 

                        <div id="campo">
                            <label for="horario">*Horário:</label><br>
                            <input type="time" id="horario" name="horario" required>
                        </div>

                         <div id="campo" class="campo-btn"> 
                            <input type="submit" id="enviar" name="submit-consulta" value="CADASTRAR">
                            <a id="voltar" href="opcoes-de-cadastro.html">Voltar</a>
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
                    echo("<script>alert('Cadastro feito com sucesso!');</script>"); 
                }
                else if($_GET["cadastro"] == "erro")
                {
                    echo("<script>alert('Erro ao cadastrar.');</script>"); 
                }
            }
        ?>

    </body>
</html>