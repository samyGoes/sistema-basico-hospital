<?php
require_once("../../../../model/Pessoa.php");
require_once("../../../../model/Medico.php");
require_once("../../../../model/HorarioMedico.php");
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
                <a href="../../index.html">início</a>
                <a href="../cadastrar/opcoes-de-cadastro.html">cadastrar</a>
                <a href="../agendar/form-agendar-consulta.php">agendar consulta</a>
                <a href="gestao-horario.html">gestão de horários</a>
            </div>
            <a href="#" id="nav-login">Login</a>
        </nav>

        <section>
            <div id="card">
                <h1> Gestão de Horários </h1>
                <div id="form">
                    <form action="cadastrar-horarios.php" method="post">
                        <div id="campo" class="campo-gestao-horario">
                              <input type="hidden" id="id-medico" name="id-medico" value="<?php echo($_POST["id-medico-horario"]); ?>">
                              <a href="cadastrar-horarios.php"><button type="submit">Cadastrar novo horário</button></a>
                        </div>
                    </form>
                </div>

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
                        $horarios = new HorarioMedico();
                        $id = $_POST["id-medico-horario"];
                        $lista = $horarios->listar($id);      

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
            </div>
        </section>


    </body>
</html>