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
    <link rel="stylesheet" href="../css/style4.css">
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
    <div class="barra">
        <a href="principalProfessor.php"><img class="cs" src="../img/casa.png"></a>
        <img class="logonav" src="../img/logo.png">
        <a href="javascript:abrirPerfil()">
            <img class="imgp" src="../img/professor/<?php echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
        </a>
    </div>
    <div id="barralat" class="barralat">
        <span style="cursor:pointer" onclick="fecharPerfil()">&times;</span>
        <img class="imgm" src="../img/professor/<?php echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
        <p class="nome"><?php echo $_SESSION["nome"]." ".$_SESSION["sobrenome"];  ?></p>
        <p class="area"><b>Área de atuação</b></p>
        <p class=""><?php echo $_SESSION["areaAtuacao"]; ?></p>
        <p class="forma"><b>Formação</b></p>
        <p class=""><?php echo $_SESSION["formacao"]; ?></p>
        <p class="email"><b>E-mail</b></p>
        <p class=""><?php echo $_SESSION["email"]; ?></p>
        <p>
            <b>
                <a class="editar" href="cadastroProfessor.php?acao=editar">Editar</a> 
                <a class="excluir" href="javascript:excluirRegistro('../control/ctrl_professor.php?acao=excluir&id=<?php echo $_SESSION["idprofessor"]; ?>')">Excluir</a>
            </b>
        </p>
        <p><b><a class="sair" href="javascript:sairSistema('../control/ctrl_professor.php?acao=deslogar')">
            <p class="nome">Sair</p>
        </a></b></p>
    </div>
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
    <div class="alunoperf">
        <img src="../img/aluno/<?php echo $vetorAluno[0]["idaluno"]."/".$vetorAluno[0]["fotoPerfil"]; ?>">

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
</div>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir aluno: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }
    function abrirPerfil(){
        document.getElementById("barralat").style.width = "400px";
    }
    function fecharPerfil(){
        document.getElementById("barralat").style.width = "0";
    }

    function excluirRegistro(url){
        if(confirm("Excluir perfil: Esta ação não pode ser desfeita. Tem certeza?"))
        location.href = url;
    }

    function sairSistema(url){
    if(confirm("Sair do Sistema: Tem certeza?"))
        location.href = url;
}
</script>