<?php
require_once("../../model/Especialidade.php"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Cadastrar Especialidades </title>
    </head>
    <body>
        
        <form action="../../controller/controller-cadastrar-medicos.php" method="post">
            <input type="text" placeholder="nome" id="nome" name="nome">
            <input type="text" placeholder="crm" id="crm" name="crm">
            <input type="text" placeholder="cpf" id="cpf" name="cpf">
            <input type="text" placeholder="telefone1" id="telefone1" name="telefone1">
            <input type="text" placeholder="telefone2" id="telefone2" name="telefone2">
            <input type="text" placeholder="cep" id="cep" name="cep" onblur="pesquisa_cep(this.value);">
            <input type="text" placeholder="logradouro" id="logradouro" name="logradouro" readonly>
            <select id="especialidade" name="especialidade">
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
            <button type="submit"> CADASTRAR </button>
        </form>


        <script src="../../assets/js/cep-auto.js"></script>
    </body>
</html>