<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorTurmas = lista("Turma", 2, $id);
    $vetorAlunos = lista("Aluno", 1, $id);
    $vetorConjuntosTurma = lista("ConjuntoTurma", 1, $id);
    $vetorConjuntos = array();
    
    foreach($vetorConjuntosTurma as $conjTurma){
        $vetorConjuntos[] = lista("Conjunto", 2, $conjTurma["conjuntoQuestoes_idconjuntoQuestoes"]);
    }
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
    <p><b>Média geral da turma: <?php
                                    if($vetorTurmas[0]["mediaGeral"] == NULL)
                                        echo "-";
                                    else
                                        echo $vetorTurmas[0]["mediaGeral"];
                                ?></b></p>
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
    <br>
    <p><b>Conjunto de Questões</b></p>
    <?php
        if($vetorConjuntos){
            foreach($vetorConjuntos as $conjunto){
                echo "<a href='conjunto.php?id=".$conjunto[0]["idconjuntoQuestoes"]."&idTurma=".$id."'>".$conjunto[0]["nome"]."</a> ";
            }
            echo "<br>";
        }
        echo "<br><a href='adicionaConjunto.php?idTurma=".$id."'>Adicionar conjunto à turma</a>";
    ?>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir turma: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }
</script>