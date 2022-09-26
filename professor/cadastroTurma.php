<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["usuario"])){
        header("location:../inicial.html");
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Turma | DAZ</title>
</head>
<body>
    <br>
    <center>
        <form action="../control/ctrl_turma.php?id=<?php echo $id; ?>" method="post">
            Nome da Turma <br>
            <input type="text" name="nome" size="40"><br>
            <br>
            Nome da Instituição <br>
            <input type="text" name="instituicao" size="40"><br>
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