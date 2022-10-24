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
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <p><a href="javascript:sairSistema('../control/ctrl_aluno.php?acao=deslogar')">(Botão para encerrar a sessão)</a></p>
    <br>
    <?php
        if($anterior <> 0){
    ?>
        <a href="questao.php?id=<?php echo $anterior; ?>">(Anterior)</a> | 
    <?php
        }
        if($proxima <> 0){
    ?>
        <a href="questao.php?id=<?php echo $proxima; ?>">(Próxima)</a>
    <?php
        } else{
    ?>
        <a href="../control/ctrl_questao.php?acao=prosseguir&idConjunto=<?php echo $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]; ?>">(Próxima)</a>
    <?php
        }
    ?>
    <br><br>
    <p>(Mídia)</p>
    <br>
    <?php
        echo $vetorQuestao[0]["enunciado"]."<br><br>";
    ?>
    <form action="../control/ctrl_questao.php?id=<?php echo $id; ?>&proxima=<?php echo $proxima; ?>&idConjunto=<?php echo $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]; ?>" method="post">
    <?php
        if($vetorQuestao[0]["tipo"] == 1){
            $vetorAlternativas = lista("Alternativas", 0, $id);
            for($i = 1; $i <= 4; $i ++){
                if($vetorAlternativas[0]["alternativa".$i] <> NULL){
    ?>
            <input type="radio" name="resposta" value="<?php echo $i; ?>"> <?php echo $vetorAlternativas[0]["alternativa".$i]; ?><br>
            <br>
    <?php
                }
            }
        } else{
    ?>
        <textarea name="resposta" rows="7" cols="50" placeholder="Sua resposta..."></textarea><br>
        <br>
    <?php
        }
    ?>
        <button type="submit" name="acao" value="responder">(Enviar)</button>
        <h5>Está com dúvida? Converse com seu professor(a)</h5>
    </form>
</body>
</html>
<script>
    function sairSistema(url){
        if(confirm("Sair do Sistema: Tem certeza?"))
            location.href = url;
    }    
</script>