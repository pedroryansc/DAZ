<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["usuario"])){
        header("location:../inicial.html");
    }

    $vetorTurmas = listaTurma(2, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turma <?php echo $vetorTurmas[0]["nome"]; ?> | DAZ</title>
</head>
<body>
    <a href="principalProfessor.php">(Home)</a><br>
    <h2>Turma <?php echo $vetorTurmas[0]["nome"]; ?></h2>
    <p><?php echo $vetorTurmas[0]["instituicao"] ?></p>
    <p>
        <b>
            <a href="cadastroTurma.php?acao=editar&id=<?php echo $vetorTurmas[0]["idturma"]; ?>">Editar</a>
            <a href="javascript:excluirRegistro('../control/ctrl_turma.php?acao=excluir&id=<?php echo $vetorTurmas[0]["idturma"]; ?>')">Excluir</a>
        </b>
    </p>
    <p>Média geral da turma: <?php echo $vetorTurmas[0]["mediaGeral"] ?></p>
    <table>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>NA/QQ*</td>
            <td>Média</td>
        </tr>
        <tr>
        </tr>
    </table>
    <p>NA = Número de Acertos; QQ = Quantidade de Questões</p>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir turma: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }
</script>