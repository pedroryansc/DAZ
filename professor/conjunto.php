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
    <p><a href="cadastroObjetiva.php?idConjunto=<?php echo $id; ?>">(Botão para cadastrar questão objetiva)</a></p>
    <p><a href="cadastroDissertativa.php?idConjunto=<?php echo $id; ?>">(Botão para cadastrar questão dissertativa)</a></p>
    <table>
        <tr>
            <th>Nº</th>
            <th>Título da Questão</th>
        </tr>
        <?php
            foreach($vetorQuestoes as $questao){
        ?>
        <tr>
            <th><?php echo $questao["idquestao"]; ?></th>
            <th><?php echo $questao["titulo"]; ?></th>
            <th><a href="cadastroQuestao.php?acao=editar&id=<?php echo $questao["idquestao"]; ?>">Editar</a></th>
            <th>
                <a href="javascript:excluirRegistro('../control/ctrl_questao.php?acao=excluir&id=<?php echo $questao["idquestao"]; ?>')">
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
            <a href="javascript:excluirRegistro('../control/ctrl_conjunto.php?acao=excluir&id=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>')">Excluir</a>
        </b>
    </p>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir conjunto: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }
</script>