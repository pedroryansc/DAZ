<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorAluno = lista("Aluno", 2, $id);
    $vetorTurma = lista("Turma", 2, $vetorAluno[0]["turma_idturma"]);
    $vetorQuestoesAluno = lista("QuestaoAluno", 0, $vetorAluno[0]["idaluno"]);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Alun<?php
                switch($vetorAluno[0]["genero"]){
                    case(1): echo "a"; break;
                    case(2): echo "o"; break;
                    case(3): echo "e"; break;
                    case(4): echo "(x)"; break;
                }
            ?>
        <?php echo $vetorAluno[0]["nome"]; ?> | DAZ
    </title>
</head>
<body>
    <a href="principalProfessor.php">(Home)</a><br>
    <br>
    <a href="turma.php?id=<?php echo $vetorAluno[0]["turma_idturma"]; ?>">(Voltar)</a><br>
    <h2>
        Alun<?php
                switch($vetorAluno[0]["genero"]){
                    case(1): echo "a"; break;
                    case(2): echo "o"; break;
                    case(3): echo "e"; break;
                    case(4): echo "(x)"; break;
                }
            ?>
        <?php echo $vetorAluno[0]["nome"]." ".$vetorAluno[0]["sobrenome"]; ?> - Turma <?php echo $vetorTurma[0]["nome"]; ?>
    </h2>
    <table>
        <tr>
            <th>Nome do Conjunto</th>
            <th>Título da Questão</th>
            <th>Resultado*</th>
            <th>Tentativas</th>
        </tr>
        <?php
            if($vetorQuestoesAluno){
                foreach($vetorQuestoesAluno as $questaoAluno){
                    $vetorQuestao = lista("Questao", 2, $questaoAluno["questao_idquestao"]);
                    $vetorConjunto = lista("Conjunto", 2, $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]);
        ?>
        <tr>
            <th><?php echo $vetorConjunto[0]["nome"]; ?></th>
            <th><?php echo $vetorQuestao[0]["titulo"]; ?></th>
            <th>
                <?php
                    if($questaoAluno["resultado"] <> NULL)
                        echo $questaoAluno["resultado"];
                    else
                        echo "-";
                ?>
            </th>
            <th><?php echo $questaoAluno["tentativas"]; ?></th>
        </tr>
        <?php
                }
            }
        ?>
    </table>
    <p>*O = Certo; X = Errado</p>
    <br>
    <p><b>Nome Completo</b></p>
    <p><?php echo $vetorAluno[0]["nome"]." ".$vetorAluno[0]["sobrenome"]; ?></p>
    <p><b>Etapa</b></p>
    <p><?php echo $vetorAluno[0]["etapa"]; ?></p>
    <p><b>Número de Acertos/Quantidade de Questões (NA/QQ)</b></p>
    <p><?php echo $vetorAluno[0]["numAcertos"]."/".$vetorAluno[0]["numQuestResp"]; ?></p>
    <p><b>Média</b></p>
    <h2><?php echo $vetorAluno[0]["media"]; ?></h2>
    
    <p>
        <b>
            <a href="cadastroAluno.php?acao=editar&id=<?php echo $id; ?>&idTurma=<?php echo $vetorAluno[0]["turma_idturma"]; ?>">Editar</a>
            <a href="javascript:excluirRegistro('../control/ctrl_aluno.php?acao=excluir&id=<?php echo $id; ?>&idTurma=<?php echo $vetorAluno[0]["turma_idturma"]; ?>')">
                Excluir
            </a>
        </b>
    </p>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir aluno: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }
</script>