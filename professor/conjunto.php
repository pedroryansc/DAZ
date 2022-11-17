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
    <link rel="stylesheet" href="../css/style.css">
    <title>Conjunto <?php echo $vetorConjunto[0]["nome"]; ?> | DAZ</title>
</head>
<body>
<div class="barra">
        <a href="principalProfessor.php"><img class="cs" src="../img/casa.png"></a>
        <center><h1>Conjunto de Questões <?php echo $vetorConjunto[0]["nome"]; ?></h1></center>
        <a href="javascript:abrirPerfil()">
            <img class="imgp" src="../img/professor/<?php //echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
        </a>
    
    <p><a href="cadastroObjetiva.php?idConjunto=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>">(Botão para cadastrar questão)</a></p>
    <div class="tab">
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
    </table></div>
    <div class="bra">
    <br>
    <img src="../img/conjunto/<?php //echo $vetorConjunto[0]["idconjuntoQuestoes"]; ?>/<?php echo $vetorConjunto[0]["imagem"]; ?>">
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
    </p></div>
</body>
</html>
<script>
    function excluirRegistro(tipo, url){
        if(confirm(`Excluir ${tipo}: Esta ação não pode ser desfeita. Tem certeza?`))
            location.href = url;
    }
    
</script>