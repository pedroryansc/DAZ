<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["idaluno"]))
        header("location:../inicial.html");
    
    $vetorTurma = lista("Turma", 2, $_SESSION["turma_idturma"]);
    $vetorConjunto = lista("Conjunto", 2, $id);
    $vetorAluno = lista("Aluno", 2, $_SESSION["idaluno"]);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fim do Conjunto <?php echo $vetorConjunto[0]["nome"]; ?> | DAZ</title>
</head>
<body>
    <p>
        Alun<?php
                switch($vetorAluno[0]["genero"]){
                    case(1): echo "a"; break;
                    case(2): echo "o"; break;
                    case(3): echo "e"; break;
                    case(4): echo "(x)"; break;
                }
            ?>
        <?php echo $vetorAluno[0]["nome"]." ".$vetorAluno[0]["sobrenome"]; ?> - Turma <?php echo $vetorTurma[0]["nome"]; ?>
    </p>
    <p><a href="javascript:sairSistema('../control/ctrl_aluno.php?acao=deslogar')">(Botão para encerrar a sessão)</a></p>
    <br>
    <h3>
        Parabéns! <br>
        Você finalizou o Conjunto <?php echo $vetorConjunto[0]["nome"]; ?>! <br>
        <br>
        Seu desempenho:
    </h3>
    <h1><?php echo $vetorAluno[0]["numAcertos"]."/".$vetorAluno[0]["numQuestResp"]; ?></h1>
    <br>
    <a href="principalAluno.php">(Prosseguir)</a>
</body>
</html>
<script>
    function sairSistema(url){
        if(confirm("Sair do Sistema: Tem certeza?"))
            location.href = url;
    }
</script>