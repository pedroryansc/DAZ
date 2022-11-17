<!DOCTYPE html>
<?php
    require("../utils.php");

    $idQuestao = isset($_GET["idQuestao"]) ? $_GET["idQuestao"] : 0;
    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorQuestao = lista("Questao", 2, $idQuestao);
    $vetorQuestoes = lista("Questao", 1, $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]);

    $vetorConjuntosTurma = lista("ConjuntoTurma", 1, $idTurma);

    $anterior = 0;
    $proxima = 0;
    
    for($i = 0; $i < count($vetorQuestoes); $i ++){
        if($vetorQuestoes[$i]["idquestao"] == $idQuestao){
            if($i - 1 >= 0)
                $anterior = $vetorQuestoes[$i - 1]["idquestao"];
            else{
                for($i2 = 0; $i2 < count($vetorConjuntosTurma); $i2 ++){
                    if($vetorConjuntosTurma[$i2]["conjuntoQuestoes_idconjuntoQuestoes"] == $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]){
                        if(!empty($vetorConjuntosTurma[$i2 - 1])){
                            $vetorQuestaoAnterior = lista("Questao", 1, $vetorConjuntosTurma[$i2 - 1]["conjuntoQuestoes_idconjuntoQuestoes"]);
                            if($vetorQuestaoAnterior){
                                for($i3 = 0; $i3 < count($vetorQuestaoAnterior); $i3 ++){
                                    if(empty($vetorQuestaoAnterior[$i3 + 1]))
                                        $anterior = $vetorQuestaoAnterior[$i3]["idquestao"];
                                }
                                break;
                            }
                        }
                    }
                }
            }
            
            if(!empty($vetorQuestoes[$i + 1]))
                $proxima = $vetorQuestoes[$i + 1]["idquestao"];
            else{
                for($i2 = 0; $i2 < count($vetorConjuntosTurma); $i2 ++){
                    if($vetorConjuntosTurma[$i2]["conjuntoQuestoes_idconjuntoQuestoes"] == $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]){
                        if(!empty($vetorConjuntosTurma[$i2 + 1])){
                            $vetorProximaQuestao = lista("Questao", 1, $vetorConjuntosTurma[$i2 + 1]["conjuntoQuestoes_idconjuntoQuestoes"]);
                            if($vetorProximaQuestao){
                                $proxima = $vetorProximaQuestao[0]["idquestao"];
                                break;
                            }
                        }
                    }
                }
            }
            break;
        }
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão '<?php echo $vetorQuestao[0]["titulo"]; ?>' | DAZ</title>
</head>
<body>
    <a href="turma.php?id=<?php echo $idTurma; ?>">(Voltar)</a><br>
    <br>
    <center>
        <a href="verificaResposta.php?idQuestao=<?php echo $idQuestao; ?>&idTurma=<?php echo $idTurma; ?>">Verificar Respostas</a><br>
        <br>
        <?php
            if(file_exists("../img/questao/".$idQuestao)){
                echo "<img src='../img/questao/".$idQuestao."/".$vetorQuestao[0]["midia"]."'>
                    <br>
                    <br>";
            }
        ?>
        <?php
            echo $vetorQuestao[0]["enunciado"]."<br><br>";
            
            if($anterior <> 0){
        ?>
            <a href="visualizarQuestao.php?idQuestao=<?php echo $anterior; ?>&idTurma=<?php echo $idTurma; ?>"> ◀</a>
        <?php
            }
            if($proxima <> 0){
        ?>
            <a href="visualizarQuestao.php?idQuestao=<?php echo $proxima; ?>&idTurma=<?php echo $idTurma; ?>"> ▶</a>
        <?php
            }
        ?>
    </center>
</body>
</html>