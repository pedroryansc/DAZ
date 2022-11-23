<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");
    
    if($acao == "editar")
        $vetorTurma = lista("Turma", 2, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style6.css">
    <title>Cadastro de Turma | DAZ</title>
</head>
<body>
    <br>
    <div class="branco2">
        <center>
            <br>
            <br>
            <br>
        <form action="../control/ctrl_turma.php?id=<?php echo $id; ?>" method="post">
            Nome da Turma <br>
            <input class="txt1" type="text" name="nome" size="40" value="<?php if($acao == "editar") echo $vetorTurma[0]["nome"]; ?>"><br>
            <br>
            Nome da Instituição <br>
            <input class="txt1" type="text" name="instituicao" size="40" value="<?php if($acao == "editar") echo $vetorTurma[0]["instituicao"]; ?>"><br>
            <br>
            <button type="submit" name="acao" value="salvar">
                <?php
                    if($acao == "editar")
                        echo "Salvar alterações";
                    else
                        echo "Salvar";
                ?>
            </button>
            </center>
        </form>
    </div>
</body>
</html>