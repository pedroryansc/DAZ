<!DOCTYPE html>
<?php
    require("../utils.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    if($acao == "editar")
        $vetorConjunto = lista("Conjunto", 2, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Conjunto de Questões | DAZ</title>
</head>
<body>
    <br>
    <center>
        <form action="../control/ctrl_conjunto.php?id=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>" method="post">
            <input type="file" name="imagem"><br>
            <br>
            Nome do Conjunto <br>
            <input type="text" name="nome" size="40" value="<?php if($acao == "editar") echo $vetorConjunto[0]["nome"]; ?>"><br>
            <br>
            Tag(s) <br>
            <input type="text" name="tags" size="40" value="<?php if($acao == "editar") echo $vetorConjunto[0]["tags"]; ?>"><br>
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