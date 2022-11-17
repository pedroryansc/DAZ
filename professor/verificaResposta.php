<!DOCTYPE html>
<?php
    require("../utils.php");

    $idQuestao = isset($_GET["idQuestao"]) ? $_GET["idQuestao"] : 0;
    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");
    
    $vetorQuestao = lista("Questao", 2, $idQuestao);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respostas da questão '<?php echo $vetorQuestao[0]["titulo"]; ?>' | DAZ</title>
</head>
<body>
    <a href="visualizarQuestao.php?idQuestao=<?php echo $idQuestao; ?>&idTurma=<?php echo $idTurma; ?>">(Voltar)</a><br>
    <br>
    <center>
        <p>Respostas</p>
        <br>
        <?php
            echo $vetorQuestao[0]["enunciado"];
        ?>
    </center>
</body>
</html>