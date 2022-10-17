<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    
    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    session_start();
    if(empty($_SESSION["usuario"]))
        header("location:../inicial.html");
    
    if($acao == "editar")
        // $vetor = listaAluno();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno | DAZ</title>
</head>
<body>
    <br>
    <center>
        <form action="../control/ctrl_aluno.php?id=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>" method="post">
            Nome <br>
            <input type="text" name="nome" size="40" value=""><br>
            <br>
            Sobrenome <br>
            <input type="text" name="sobrenome" size="40" value=""><br>
            <br>
            Gênero <br>
            <select name="genero">
                <option value="">Selecione</option>
                <option value="1">Feminino</option>
                <option value="2">Masculino</option>
                <option value="3">Não-Binário</option>
                <option value="4">Prefiro não dizer</option>
            </select><br>
            <br>
            Etapa <br>
            <select name="etapa">
                <option value="">Selecione</option>
                <option value="Ensino Fundamental">Ensino Fundamental</option>
                <option value="Ensino Médio">Ensino Médio</option>
            </select><br>
            <br>
            <button type="submit" name="acao" value="salvar">
                <?php
                    if($acao == "editar")
                        echo "Salvar alterações";
                    else
                        echo "Salvar";
                ?>
            </button>
        </form>
    </center>
</body>
</html>