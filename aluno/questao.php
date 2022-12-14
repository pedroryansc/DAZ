<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["idaluno"]))
        header("location:../inicial.html");

    $vetorTurma = lista("Turma", 2, $_SESSION["turma_idturma"]);
    
    $vetorQuestao = lista("Questao", 2, $id);
    $vetorQuestoes = lista("Questao", 1, $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]);

    $anterior = 0;
    $proxima = 0;
    for($i = 0; $i < count($vetorQuestoes); $i ++){
        if($vetorQuestoes[$i]["idquestao"] == $id){
            if($i - 1 >= 0)
                $anterior = $vetorQuestoes[$i - 1]["idquestao"];
            if(!empty($vetorQuestoes[$i + 1]))
                $proxima = $vetorQuestoes[$i + 1]["idquestao"];
            break;
        }
    }

    $vetorQuestaoAluno = lista("QuestaoAluno", $id, $_SESSION["idaluno"]);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../script/sinc.js"></script>
    <title>Questão '<?php echo $vetorQuestao[0]["titulo"]; ?>' | DAZ</title>
</head>
<body>
    <p>
        Alun<?php
                switch($_SESSION["genero"]){
                    case(1): echo "a"; break;
                    case(2): echo "o"; break;
                    case(3): echo "e"; break;
                    case(4): echo "(x)"; break;
                }
            ?>
            <?php echo $_SESSION["nome"]." ".$_SESSION["sobrenome"]; ?> - Turma <?php echo $vetorTurma[0]["nome"]; ?>
    </p>
    <p><a href="javascript:sairSistema('../control/ctrl_aluno.php?acao=deslogar')"class="sair">x</a></p>
    <br>
    <d class="controle">
        <center>
    <?php
        if($anterior <> 0){
    ?>
        <a href="questao.php?id=<?php echo $anterior; ?>"class="ant"> ◀</a>
    <?php
        }
        if($proxima <> 0){
    ?>
        <a href="questao.php?id=<?php echo $proxima; ?>"class="prox"> ▶</a>
    <?php
        } else{
            if($vetorQuestaoAluno){
                if($vetorQuestaoAluno[0]["resultado"] == "O" || $vetorQuestao[0]["maximoCaracteres"] <> NULL){
    ?>
        <a href="../control/ctrl_questao.php?acao=prosseguir&idConjunto=<?php echo $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]; ?>"class="prox">▶</a>
    <?php
                }
            }
        }
    ?></div>
    <br><br>
    <p>
        (Mídia)
        <?php
            if(file_exists("../img/questao/".$vetorQuestao[0]["idquestao"])){
                echo "<img src='../img/questao/".$vetorQuestao[0]["idquestao"]."/".$vetorQuestao[0]["midia"]."'>";
            }
        ?>    
    </p>
    <br>
    <div class="disbra">
    <div class="enum">
    <?php
        echo $vetorQuestao[0]["enunciado"]."<br><br>";
    ?>
    </div>
    <form action="../control/ctrl_questao.php?id=<?php echo $id; ?>&proxima=<?php echo $proxima; ?>&idConjunto=<?php echo $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]; ?>" method="post">
    <?php
        if($vetorQuestao[0]["tipo"] == 1){
            $vetorAlternativas = lista("Alternativas", 0, $id);
            for($i = 1; $i <= 4; $i ++){
                if($vetorAlternativas[0]["alternativa".$i] <> NULL){
    ?>
            <input class="op" type="radio" name="resposta" value="<?php echo $i; ?>" <?php
                                                                            if($vetorQuestaoAluno){
                                                                                if($vetorQuestaoAluno[0]["resultado"] == "O"){
                                                                                    if($vetorQuestaoAluno[0]["resposta"] == $i)
                                                                                        echo "checked";
                                                                                    else
                                                                                        echo "disabled";
                                                                                }
                                                                            }
                                                                        ?>> <?php echo $vetorAlternativas[0]["alternativa".$i]; ?><br>
            <br>
    <?php
                }
            }
        } else{
    ?>
        <textarea id="resposta" name="resposta" rows="7" cols="50" placeholder="Sua resposta..."><?php
                                                                                    if($vetorQuestaoAluno)
                                                                                        echo $vetorQuestaoAluno[0]["resposta"];
                                                                                ?></textarea>
                                                                                
                                                                                <br>
        
        <input type="hidden" id="alunoid" name="alunoid" value="<?php echo $_SESSION["idaluno"] ?>">                                                                        <br>
    <?php
        }
        
        if(!$vetorQuestaoAluno || $vetorQuestaoAluno[0]["resultado"] == "X" || $vetorQuestao[0]["maximoCaracteres"] <> NULL){
    ?>
        <button type="submit" name="acao" value="responder">▶</button>
        <h5>Está com dúvida? Converse com seu professor(a)</h5>
    <?php
        }
    ?>
    </form></center></div>
</body>
</html>
<script>
    function sairSistema(url){
        if(confirm("Sair do Sistema: Tem certeza?"))
            location.href = url;
    }    
</script>