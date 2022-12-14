<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorTurmas = lista("Turma", 1, $_SESSION["idprofessor"]);
    $vetorTurma = lista("Turma", 2, $id);
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
    <link rel="stylesheet" href="../css/style4.css">
    <title>Turma <?php echo $vetorTurma[0]["nome"]; ?> | DAZ</title>
</head>
<body>
<div class="barra">
        <a href="principalProfessor.php"><img class="cs" src="../img/casa.png"></a>
        <img class="logonav" src="../img/logo.png">
        <a href="javascript:abrirPerfil()">
            <img class="imgp" src="../img/professor/<?php echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
        </a>
    </div>
    <div class="branco">
    <?php
        foreach($vetorTurmas as $turma){
            echo "<a href='turma.php?id=".$turma["idturma"]."'>Turma ".$turma["nome"]."</a><br><br>";
        }
    ?>
    <p><a href="cadastroTurma.php">(Botão para criar turma)</a></p></div>
    <br>
    <div class="infot">
    <center><h2>Turma <?php echo $vetorTurma[0]["nome"]; ?></h2>
    <p><?php echo $vetorTurma[0]["instituicao"] ?></p></center>

    <center>
    <p class="nota"><b><?php
                                    if($vetorTurma[0]["mediaGeral"] == NULL)
                                        echo "-";
                                    else
                                        echo $vetorTurma[0]["mediaGeral"];
                                ?></b></p>
    <p>
    </center>
        <b>
            <a class="left" href="cadastroTurma.php?acao=editar&id=<?php echo $id; ?>">Editar</a>
            <a class="right" href="javascript:excluirRegistro('../control/ctrl_turma.php?acao=excluir&id=<?php echo $id; ?>')">Excluir</a>
            <br>
            <br>
            <center>
                <?php
                    $vetorQuestao = array();

                    foreach($vetorConjuntosTurma as $conjuntoTurma){
                        $vetorQuestao = lista("Questao", 1, $conjuntoTurma["conjuntoQuestoes_idconjuntoQuestoes"]);
                        if($vetorQuestao){
                            echo "<a href='visualizarQuestao.php?idQuestao=".$vetorQuestao[0]["idquestao"]."&idTurma=".$id."'>Iniciar a Aula</a>";
                            break;
                        }
                    }
                    
                    if(!$vetorConjuntos)
                        echo "Adicione conjuntos com questões à turma para <br> Iniciar a Aula";

                    if($vetorConjuntos && !$vetorQuestao)
                        echo "Adicione questões à turma para <br> Iniciar a Aula";
                ?>   
            </center>
        </b>
    </p>
    <br>
    
    <br></div>
    <div class="tab">
    <table >
    <a href="cadastroAluno.php?idTurma=<?php echo $id; ?>" class="newal"><img src="../img/cadalu.png" alt="" class="addalu"></a>
    
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
                <a class="nomes" href="aluno.php?id=<?php echo $aluno["idaluno"]; ?>">
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
    <p class="legenda">*NA = Número de Acertos; QQ = Quantidade de Questões</p>
</div>
    
    <!-- Sugestão: ao invés de QQ, colocar "NQ = Número de Questões" para ficar com a mesma letra inicial de NA -->
    <br>
    <div class="tconj">
    <p><b>Conjunto de Questões</b></p>
    <?php
        if($vetorConjuntos){
            foreach($vetorConjuntos as $conjunto){
                echo "<div class='bolconj'><br><br><br>
                      <div class='margin'>
                      <a class='nomeconj' href='conjunto.php?id=".$conjunto[0]["idconjuntoQuestoes"]."&idTurma=".$id."'>".$conjunto[0]["nome"]."</a></div> </div>";
            }
            echo "<br>";
        }
        echo "<br><hr><center><a class='baixo' href='adicionaConjunto.php?idTurma=".$id."'>Adicionar conjunto à turma</a></center>";
    ?></div>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir turma: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }
</script>