<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorTurmas = lista("Turma", 2, $id);
    $vetorAlunos = lista("Aluno", 1, $id);
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
            <a href="cadastroTurma.php?acao=editar&id=<?php echo $id; ?>">Editar</a>
            <a href="javascript:excluirRegistro('../control/ctrl_turma.php?acao=excluir&id=<?php echo $id; ?>')">Excluir</a>
        </b>
    </p>
    <br>
    <p>Média geral da turma: <?php echo $vetorTurmas[0]["mediaGeral"] ?></p>
    <br>
    <p><a href="cadastroAluno.php?idTurma=<?php echo $id; ?>">(Botão para cadastrar aluno)</a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>NA/QQ*</th>
            <th>Média</th>
        </tr>
        <?php
            foreach($vetorAlunos as $aluno){
        ?>
        <tr>
            <th><?php echo $aluno["idaluno"]; ?></th>
            <td>
                <a href="aluno.php?id=<?php echo $aluno["idaluno"]; ?>">
                    <?php echo $aluno["nome"]." ".$aluno["sobrenome"]; ?>
                </a>
            </td>
            <th><?php echo $aluno["numAcertos"]."/".$aluno["numQuestResp"]; ?></th>
            <th>
                <?php
                    if($aluno["media"] == NULL)
                        echo "-";
                    else
                        echo $aluno["media"];
                ?>
            </th>
        </tr>
        <?php
            }
        ?>
    </table>
    <p>*NA = Número de Acertos; QQ = Quantidade de Questões</p>
    <!-- Sugestão: ao invés de QQ, colocar "NQ = Número de Questões" para ficar com a mesma letra inicial de NA -->
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir turma: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }
</script>