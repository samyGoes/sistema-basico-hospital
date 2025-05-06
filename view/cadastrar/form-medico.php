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

    </body>
</html>