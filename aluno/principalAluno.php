<!DOCTYPE html>
<?php
    require("../utils.php");

    session_start();
    if(!empty($_SESSION["idaluno"])){
        $vetorTurma = lista("Turma", 2, $_SESSION["turma_idturma"]);
    } else
        header("location:../inicial.html");
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal (Aluno) | DAZ</title>
</head>
<body>
    <p>
        Alun<?php
                switch($_SESSION["genero"]){
                    case(1): echo "a"; break;
                    case(2): echo "o"; break;
                    case(3): echo "e"; break;
                }
            ?>
        <?php echo $_SESSION["nome"]." ".$_SESSION["sobrenome"]; ?> - Turma <?php echo $vetorTurma[0]["nome"]; ?>
    </p>
    <p><a href="javascript:sairSistema('../control/ctrl_aluno.php?acao=deslogar')">(Botão para encerrar a sessão)</a></p>
    <br>
    <h2>
        Bem-vindo ao DAZ! <br>
        Sua aula já vai começar
    </h2>
    <p><a href="questao.php">(Botão para iniciar)</a></p>
</body>
</html>
<script>
    function sairSistema(url){
        if(confirm("Sair do Sistema: Tem certeza?"))
            location.href = url;
    }
</script>