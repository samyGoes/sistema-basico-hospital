<?php
require_once("../../../model/Pessoa.php");
require_once("../../../model/Medico.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../assets/css/style.css">
        <link rel="stylesheet" href="../../../assets/css/style-lista-medicos.css">
        <link rel="stylesheet" href="../../../assets/css/style-modal.css">
        <title> Médicos Cadastrados </title>
    </head>
    <body>

        <div class="modal">
            <p> Deseja realmente desativar este usuário? </p>
            <form action="../../../controller/controller-desativar-medicos.php" method="post">
                <input type="submit" id="id-medico-desativar" name="id-medico-desativar" value="<?php echo($_POST["id-desativar"]); ?>">
                <button type="button" id="btn-cancelar"> CANCELAR </button>
            </form>
        </div>


        <nav>
            <div id="nav-logo">Logo</div>
            <div id="nav-menu">
                <a href="../../../index.html">início</a>
                <a href="../../cadastrar/opcoes-de-cadastro.html">cadastrar</a>
                <a href="../../agendar/form-agendar-consulta.php">agendar consulta</a>
                <a href="../../gestao-horario/gestao-horario.php">gestão de horários</a>
            </div>
            <a href="#" id="nav-login">Login</a>
        </nav>

        <section>
            <div id="card">
                <h1> Médicos Cadastrados </h1>
               
                <a href="cadastrar-medicos.php" id="link-cadastro" style="color:black;"> Cadastrar novo médico </a>

                <table>
                    <thead>
                        <th> ID </th>
                        <th> CRM </th>
                        <th> nome </th>
                        <th> data admissão </th>
                        <th> especialidade </th>
                        <th> CPF </th>
                        <th> gênero </th>
                        <th> CEP </th>
                        <th> email </th>
                        <th> editar </th>
                        <th> excluir </th>
                        <th> horários </th>
                    </thead>
                    <tbody>
                    <?php
                        $medicos = new Medico();
                        $lista = $medicos->listar();      
                        
                        foreach($lista as $l)
                        {
                    ?>
                            <tr>
                                <td> <?php echo($l["id_medico"]); ?> </td>
                                <td> <?php echo($l["crm_medico"]); ?> </td>
                                <td> <?php echo($l["nome_pessoa"]); ?> </td>
                                <td> 
                                    <?php 
                                        $data = strtotime($l["data_admissao"]);
                                        $dataConvertida = date("d-m-Y", $data);
                                        echo($dataConvertida);
                                    ?> 
                                </td>
                                <td> <?php echo($l["desc_especialidade"]); ?> </td>
                                <td> <?php echo($l["cpf_pessoa"]); ?> </td>
                                <td> <?php echo($l["genero_pessoa"]); ?> </td>
                                <td> <?php echo($l["cep_pessoa"]); ?> </td>
                                <td> <?php echo($l["email_pessoa"]); ?> </td>
                                <td> 
                                    <form action="atualizar-medicos.php" method="post">                                        
                                        <input type="hidden" id="id" name="id" value="<?php echo($l["id_medico"]); ?>">
                                        <a href="atualizar-medicos.php"><button type="submit"> EDITAR </button></a>                                        
                                    </form>    
                                </td>
                                <td>
                                    <form action="lista-de-medicos.php" method="post">
                                        <input type="hidden" id="id-desativar" name="id-desativar" value="<?php echo($l["id_medico"]); ?>">
                                        <button class="btn-desativar" type="submit"> desativar</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="gestao-horario/gestao-horario.php" method="post">                                        
                                        <input type="hidden" id="id-medico-horario" name="id-medico-horario" value="<?php echo($l["id_medico"]); ?>">
                                        <a href="gestao-horario/gestao-horario.php"><button type="submit"> HORÁRIOS </button></a>                                        
                                    </form>  
                                </td>
                            </tr>    
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>


        <?php
            if(isset($_GET["atualizacao"]))
            {
                if($_GET["atualizacao"] == "sucesso") 
                { 
                    echo("<script> alert('Atualização feita com sucesso!'); </script>"); 
                }
            }
        ?>

        <script src="../../../assets/js/modal.js"></script>
    </body>
</html>