<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if(!empty($_SESSION["idprofessor"])){
        $vetorTurmas = lista("Turma", 1, $_SESSION["idprofessor"]);
        $vetorConjuntos = lista("Conjunto", 1, $_SESSION["idprofessor"]);
    } else
        header("location:../inicial.html");
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style4.css">
    <title>Página principal | DAZ</title>
</head>
<body>
    <div class="barra">
    <a href="principalProfessor.php"><img class="cs" src="../img/casa.png"></a>
   <img class="logonav" src="../img/logo.png">
   <img class="imgp" src="../img/<?php echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
    </div>
   <!-- Se o <aside> for retirado, a página desconfigura (penso que seja melhor encontrar outro metodo de organizar) --> 
   
   <aside class="branco">
            <?php
                if($vetorTurmas){
                    foreach($vetorTurmas as $turma){
                        echo "<a href='turma.php?id=".$turma["idturma"]."'>Turma ".$turma["nome"]."</a><br><br>";
                    }
                } else
                    echo "Clique no botão para criar uma turma <br><br>";
            ?>
            <p><a href="cadastroTurma.php">(Botão para criar turma)</a></p>
    </aside>
    <aside>
                <h3>Conjuntos de Questões</h3>
                <?php
                    if($vetorConjuntos){
                        foreach($vetorConjuntos as $conjunto){
                            echo "<a href='conjunto.php?id=".$conjunto["idconjuntoQuestoes"]."'>".$conjunto["nome"]."</a> ";
                        }
                    } else
                        echo "Clique no botão para criar um conjunto de questões <br><br>";
                ?>
                <p><a href="cadastroConjunto.php">(Botão para criar conjunto)</a></p>
                <h3>Materiais de apoio</h3>>
                </aside>
                <!--
     <img class="imgm"src="../img/<?php echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
     


         <p class="nome"><?php echo $_SESSION["nome"]." ".$_SESSION["sobrenome"];  ?></p>
    <p ><b>Área de atuação</b></p>
    <p ><?php echo $_SESSION["areaAtuacao"]; ?></p>
    <p><b>Formação</b></p>
    <p ><?php echo $_SESSION["formacao"]; ?></p>
    <p ><b>E-mail</b></p>
    <p ><?php echo $_SESSION["email"]; ?></p>
    <p>
        <b>
            <a class="editar" href="cadastroProfessor.php?acao=editar">Editar</a> 
            <a class="excluir" href="javascript:excluirRegistro('../control/ctrl_professor.php?acao=excluir&id=<?php echo $_SESSION["idprofessor"]; ?>')">Excluir</a>
        </b>
    </p>
   <p><b><a class="sair" href="javascript:sairSistema('../control/ctrl_professor.php?acao=deslogar')"><p class="nome">Sair</p></a></b></p>-->
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir perfil: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }

    function sairSistema(url){
        if(confirm("Sair do Sistema: Tem certeza?"))
            location.href = url;
    }
</script>

