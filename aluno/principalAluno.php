<!DOCTYPE html>
<?php
    require("../utils.php");

    session_start();
    if(empty($_SESSION["idaluno"]))
        header("location:../inicial.html");
    
    $vetorTurma = lista("Turma", 2, $_SESSION["turma_idturma"]);
    $vetorAluno = lista("Aluno", 2, $_SESSION["idaluno"]);

    $idQuestao = 0;

    if($vetorAluno[0]["ultimaQuestao"] <> NULL)
        $idQuestao = $vetorAluno[0]["ultimaQuestao"];
    else{
        $vetorConjuntosTurma = lista("ConjuntoTurma", 1, $_SESSION["turma_idturma"]);
        if($vetorConjuntosTurma){
            $vetorQuestoes = lista("Questao", 1, $vetorConjuntosTurma[0]["conjuntoQuestoes_idconjuntoQuestoes"]);
            if($vetorQuestoes)
                $idQuestao = $vetorQuestoes[0]["idquestao"];
        }
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Página principal | DAZ</title>
</head>
<body>
    <p>
        <!-- <img src="../img/aluno/<?php echo $vetorAluno[0]["idaluno"]; ?>/<?php echo $vetorAluno[0]["fotoPerfil"]; ?>" width="50"> -->
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
    <p ><a href="javascript:sairSistema('../control/ctrl_aluno.php?acao=deslogar')"class="sair">x</a></p>
    <br>
    <div class="blablur">
        <img src="../img/espalu.svg" class="esp">
    <h2>
        Bem-vindo ao DAZ! <br>
    <?php
        if($idQuestao == 0){
    ?>
        Peça ao seu professor(a) para que ele/ela adicione conjuntos de questões à turma </h2>
    <?php
        } else{
    ?>
        Sua aula já vai começar
        <!-- Ideia: Ao invés do texto acima, poderíamos colocar "Clique no botão abaixo para começar a responder" -->
    </h2>
    <p class="come">
        <br><a href="questao.php?id=<?php echo $idQuestao; ?>"class="play">▶</a></p>
    <?php
        }
    ?>
    </div>
</body>
</html>
<script>
    function sairSistema(url){
        if(confirm("Sair do Sistema: Tem certeza?"))
            location.href = url;
    }
</script>