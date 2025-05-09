<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/style-especialidades.css">
        <title> Agendar Consulta</title>
    </head>
    <body>
        <nav>
            <div id="nav-logo">Logo</div>
            <div id="nav-menu">
                <a href="opcoes-de-cadastro.html">cadastrar</a>
                <a href="../agendar/form-agendar-consulta.html">agendar consulta</a>
                <a href="../gestao-horario/gestao-horario.php">gestão de horários</a>
            </div>
            <a href="#" id="nav-login">Login</a>
        </nav>

        <section>
            <div id="card">
                <h1> Cadastrar Especialidades </h1>
                <div id="form">
                    <form action="../../controller/controller-cadastrar-especialidade.php" method="post">
                        <div id="campo" class="campo-especialidade">
                            <label for="nome-especialidade">Nome Da Especialidade:</label>
                            <input type="text" id="nome-especialidade" name="nome-especialidade">
                        </div> 
                        <!-- class="campo-btn" -->
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
                if(isset($_GET["cadastro"]) == "sucesso") 
                { echo("<script>alert('Cadastro feito com sucesso!');</script>"); }
            }
        ?>

        <script src="../../assets/js/script.js"></script>
    </body>
</html>