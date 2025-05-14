<?php
require_once("../../model/Pessoa.php");
require_once("../../model/Medico.php");
require_once("../../model/Especialidade.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <title> Agendar Consulta</title>
    </head>
    <body>
        <nav>
            <div id="nav-logo">Logo</div>
            <div id="nav-menu">
                <a href="../../index.html">início</a>
                <a href="../cadastrar/opcoes-de-cadastro.html">cadastrar</a>
                <a href="form-agendar-consulta.php">agendar consulta</a>
            </div>
            <a href="#" id="nav-login">Login</a>
        </nav>

        <section>
            <div id="card">
                <h1> Agendar Consulta </h1>
                <div id="form">
                    <form>
                        <div id="campo">
                            <label for="especialidade">Selecione a especialidade:</label><br>                        
                            <select name="especialidade" id="especialidade">
                                <option value="0" disabled>Selecione...</option> 
                            <?php
                                $especialidade = new Especialidade();
                                $lista = $especialidade->listar();
                                foreach($lista as $l)
                                {
                            ?>
                                   <option value="<?php echo($l["id_especialidade"]); ?>">
                                        <?php echo($l["desc_especialidade"]); ?>
                                   </option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div id="campo">
                            <label for="medico">Selecione o médico:</label><br>
                            <select name="medico" id="medico">
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
                            <label for="data-consulta">Data da consulta:</label><br>
                            <input type="date" id="data-consulta" name="data-consulta">
                        </div>
                        <div id="campo">
                            <label for="hora-consulta">Horário da consulta:</label><br>
                            <input type="time" id="hora-consulta" name="hora-consulta">
                        </div>
                        <div id="campo">
                            <label for="cpf-paciente">CPF do paciente:</label><br>
                            <input type="text" id="cpf-paciente" name="cpf-paciente">
                        </div>
                        <div id="campo">
                            Selecione o tipo da consulta:<br>
                            <input type="radio" id="convenio-consulta" name="tipo-consulta" value="convenio" checked><label for="convenio-consulta">Convênio</label>
                            <input type="radio" id="particular-consulta" name="tipo-consulta" value="particular"><label for="particular-consulta">Particular</label>
                        </div>
                        <div id="campo" class="campo-btn">
                            <input type="submit" id="enviar" name="submit-consulta" value="AGENDAR">
                            <button type="submit" id="btn-gambiarra"> <a href="pagamento.html" id="btn-continuar">CONTINUAR</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        <script src="../../assets/js/btns-agendar.js"></script>
    </body>
</html>