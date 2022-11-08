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
        <a href="javascript:abrirPerfil()">
            <img class="imgp" src="../img/<?php echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
        </a>
    </div>
    
    <div id="principal">
        <!-- Se o <aside> for retirado, a página desconfigura (penso que seja melhor encontrar outro metodo de organizar) --> 
    
        <aside class="branco">
            <?php
                if($vetorTurmas){
                    foreach($vetorTurmas as $turma){
                        echo "<a  class='nomet'href='turma.php?id=".$turma["idturma"]."'>Turma ".$turma["idturma"]."</a><br><p>".$turma["nome"]."</p></<br>";
                    }
                } else
                    echo "<p class='aviso'>Clique no botão para criar uma turma</p> <br><br>";
            ?>
            <a class="bola"href="cadastroTurma.php">+</a>
        </aside>
        <aside class="conj">
                    <h3 class="apoiotot">Conjuntos de Questões</h3>
                    <?php
                        if($vetorConjuntos){
                            foreach($vetorConjuntos as $conjunto){
                                echo "<a href='conjunto.php?id=".$conjunto["idconjuntoQuestoes"]."'>".$conjunto["nome"]."</a> ";
                            }
                        } else
                            echo "<p class='aviso'>Clique no botão para criar um conjunto de questões</p> <br><br>";
                    ?>
                    <p class="cria"><a class="link" href="cadastroConjunto.php">+</a></p></aside>
        <div class="apoio">
            <h3 class="apoiotit">Materiais de apoio</h3>
            <iframe width="399" height="225"  src="https://www.youtube.com/embed/tw53UNb8FCA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            <iframe width="399" height="225" src="https://www.youtube.com/embed/3EmTmGF3ZqY?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    
    <div id="barralat" class="barralat"> <!-- Continuar: https://www.w3schools.com/howto/howto_js_sidenav.asp -->
        <span style="cursor:pointer" onclick="fecharPerfil()">&times;</span>
        <img class="imgm"src="../img/<?php echo $_SESSION["idprofessor"]."/".$_SESSION["fotoPerfil"]; ?>">
        <p class="nome"><?php echo $_SESSION["nome"]." ".$_SESSION["sobrenome"];  ?></p>
        <p><b>Área de atuação</b></p>
        <p><?php echo $_SESSION["areaAtuacao"]; ?></p>
        <p><b>Formação</b></p>
        <p><?php echo $_SESSION["formacao"]; ?></p>
        <p><b>E-mail</b></p>
        <p><?php echo $_SESSION["email"]; ?></p>
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
</body>
</html>
<script>
    function abrirPerfil(){
        document.getElementById("barralat").style.width = "450px";
        document.getElementById("principal").style.marginRight = "450px";
        document.body.style.backgroundColor = "rgba(0, 0, 0, 0.4)";
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