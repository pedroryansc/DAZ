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
        <br>
        <br>
        <?php
            $vetorQuestaoAlunos = lista("QuestaoAluno", $idQuestao, 0);
            foreach($vetorQuestaoAlunos as $questaoAluno){
                $vetorAluno = lista("Aluno", 2, $questaoAluno["aluno_idaluno"]);
                echo "<img src='../img/aluno/".$vetorAluno[0]["idaluno"]."/".$vetorAluno[0]["fotoPerfil"]."' width='50'> ".$vetorAluno[0]["nome"]." ".$vetorAluno[0]["sobrenome"].
                    "<br><br>";
                if($vetorQuestao[0]["tipo"] == 1){
                    $vetorAlternativas = lista("Alternativas", 0, $idQuestao);
                    for($i = 1; $i <= 4; $i ++){
                        if($questaoAluno["resposta"] == $i)
                            echo $vetorAlternativas[0]["alternativa".$i]."<br><br>";
                    }
                } else
                    echo $questaoAluno["resposta"]."<br><br>";
            }
        ?>
        <br>
    </center>
</body>
</html>