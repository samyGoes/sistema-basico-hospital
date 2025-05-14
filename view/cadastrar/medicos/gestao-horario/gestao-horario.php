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
        <link rel="stylesheet" href="../../../../assets/css/style-tabela.css">
        <title> Gestão de Horários </title>
    </head>
    <body>
        <nav>
            <div id="nav-logo">Logo</div>
            <div id="nav-menu">
                <a href="../../../../index.html">início</a>
                <a href="../../opcoes-de-cadastro.html">cadastrar</a>
                <a href="../../../agendar/form-agendar-consulta.php">agendar consulta</a>
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
                <h1> Gestão de Horários </h1>
                <h2> Doutor(a) <?php echo($nome); ?></h2>
                <a id="a" href="cadastrar-horarios.php">Cadastrar novo horário</a>

                <table>
                    <thead>
                        <th> Horários </th>
                        <th> Segunda </th>
                        <th> Terça </th>
                        <th> Quarta </th>
                        <th> Quinta </th>
                        <th> Sexta </th>
                    </thead>
                    <tbody>
                    <?php                    
                        foreach($lista as $l)
                        {
                    ?>
                            <tr>
                                <td> <?php echo($l["horario_hm"]); ?> </td>
                            </tr>    
                    <?php                        
                        }
                    ?>
                    </tbody>
                </table>
                <a id="voltar" href="../lista-de-medicos.php">Voltar</a>
            </div>
        </section>


    </body>
</html>