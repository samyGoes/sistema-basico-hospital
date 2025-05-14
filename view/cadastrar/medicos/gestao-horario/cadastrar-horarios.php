<?php
require_once("../../../../model/Pessoa.php");
require_once("../../../../model/Medico.php");
require_once("../../../../model/HorarioMedico.php");
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../../assets/css/style.css">
        <link rel="stylesheet" href="../../../../assets/css/style-horarios.css">
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
            <?php
                $horarios = new HorarioMedico();
                $pessoa = new Pessoa();

                $lista = $horarios->listar($_SESSION["id-medico"]);   
                $nome = $pessoa->listaNome($_SESSION["id-medico"]);     
            ?>
            <div id="card">
                <h1> Cadastrar Horários dos Médicos </h1>
                <div id="form">
                    <form action="../../../../controller/controller-cadastrar-horarios.php" method="post">
                        <div id="campo" class="campo">
                            <label for=""> Doutor(a) <?php echo($nome); ?> </label>
                            <input type="hidden" id="id" name="id" value="<?php echo($_SESSION["id-medico"]); ?>" readonly>
                        </div>
                        <div id="campo" class="campo">
                            <label for="horario">*Data:</label><br>
                            <input type="date" id="data" name="data" required>
                        </div>

                        <div id="campo">
                            <label for="horario">*Horário:</label><br>
                            <input type="time" id="horario" name="horario" required>
                        </div>

                         <div id="campo" class="campo-btn"> 
                            <input type="submit" id="enviar" name="submit-consulta" value="CADASTRAR">
                            <a id="voltar" href="gestao-horario.php">Voltar</a>
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