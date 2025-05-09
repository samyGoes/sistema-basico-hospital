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
        <link rel="stylesheet" href="../../assets/css/style-tabela.css">
        <title> Gestão de Horários </title>
    </head>
    <body>
        <nav>
            <div id="nav-logo">Logo</div>
            <div id="nav-menu">
                <a href="../cadastrar/opcoes-de-cadastro.html">cadastrar</a>
                <a href="../agendar/form-agendar-consulta.html">agendar consulta</a>
                <a href="gestao-horario.html">gestão de horários</a>
            </div>
            <a href="#" id="nav-login">Login</a>
        </nav>

        <section>
            <div id="card">
                <h1> Gestão de Horários </h1>
                <div id="form">
                    <form>
                        <div id="campo" class="campo-gestao-horario">
                            <p>
                                <label for="medico">Selecione o médico:</label>  
                                <select name="medico" id="medico">
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
                            </p>
                            <input type="submit" id="enviar" name="submit-consulta" value="BUSCAR">    
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
                        <tr>
                            <td> 09:00 </td>
                        </tr>    
                        <tr>
                            <td> 09:30 </td>
                        </tr>                 
                    </tbody>
                </table>
            </div>
        </section>


    </body>
</html>