<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");
    
    $vetorConjunto = lista("Conjunto", 2, $id);
    $vetorQuestoes = lista("Questao", 1, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjunto <?php echo $vetorConjunto[0]["nome"]; ?> | DAZ</title>
</head>
<body>
    <a href="principalProfessor.php">(Home)</a><br>
    <br>
    <a href="
        <?php
            if($idTurma == 0)
                echo "principalProfessor.php";
            else
                echo "turma.php?id=".$idTurma;
        ?>
    ">(Voltar)</a>
    <h2>Conjunto de Questões <?php echo $vetorConjunto[0]["nome"]; ?></h2>
    <p><a href="cadastroObjetiva.php?idConjunto=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>">(Botão para cadastrar questão)</a></p>
    <table>
        <tr>
            <th>Título da Questão</th>
            <th>Tipo</th>
        </tr>
        <?php
            foreach($vetorQuestoes as $questao){
                if($questao["tipo"] == 1)
                    $tipo = "Objetiva";
                else
                    $tipo = "Dissertativa";
        ?>
        <tr>
            <th><?php echo $questao["titulo"]; ?></th>
            <th><?php echo $tipo; ?></th>
            <th>
                <a href="cadastro<?php echo $tipo; ?>.php?acao=editar&id=<?php echo $questao["idquestao"]; ?>&idConjunto=<?php echo $questao["conjuntoQuestoes_idconjuntoQuestoes"]; ?>&idTurma=<?php echo $idTurma; ?>">
                    Editar
                </a>
            </th>
            <th>
                <a href="javascript:excluirRegistro('questão', '../control/ctrl_questao.php?acao=excluir&id=<?php echo $questao["idquestao"]; ?>&idConjunto=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>')">
                    Excluir
                </a>
            </th>
        </tr>
        <?php
            }
        ?>
    </table>
    <br>
    <p><b>Nome do Conjunto</b></p>
    <p><?php echo $vetorConjunto[0]["nome"]; ?></p>
    <p><b>Tags</b></p>
    <?php
        $tags = explode(",", $vetorConjunto[0]["tags"]);
        foreach($tags as $tag){
            echo $tag."<br>";
        }
    ?>
    <br>
    <p>
        <b>
            <a href="cadastroConjunto.php?acao=editar&id=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>">Editar</a>
            <a href="javascript:excluirRegistro('conjunto', '../control/ctrl_conjunto.php?acao=excluir&id=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>')">Excluir</a>
        </b>
    </p>
</body>
</html>
<script>
    function excluirRegistro(tipo, url){
        if(confirm(`Excluir ${tipo}: Esta ação não pode ser desfeita. Tem certeza?`))
            location.href = url;
    }
    
</script>