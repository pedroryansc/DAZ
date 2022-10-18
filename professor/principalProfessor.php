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
    <title>Página principal (Professor) | DAZ</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap');
        
        body{
            width: 98%;
            height: 641PX;
            background: linear-gradient(180deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);
            margin: 0;
            padding: 0;
        } 

        div.navbar{
            background-color: #F3BD1D;
            width: 102%;
            margin-top: -0.1%;
        }

        img.casa{
            width: 4%;
            position: absolute;
            margin-top: -4.7%;
            margin-left: 0.5%;
        }

        img.casa1{
            width: 7.5%;
            position: absolute;
            margin-top: -4.4%;
            margin-left: 45%;
        }

        img.casa2{
            width: 4%;
            position: absolute;
            margin-top: -4.5%;
            margin-left: 95%;
            border-radius: 50%;
        }

        a.nomeprof{
            color: white;
        }

        div.branco{
            background-color: white;
            float: right;
            color: black;
            font-family: nunito;
            height: 83%;
            margin-top: -0%;
            margin-right: -1.8%;
            padding: 2%;
            width: 22%;
        }

        /* Classe de <div> criada para teste */

        div.brancoLeft{
            background-color: white;
            float: left;
            color: black;
            font-family: nunito;
            height: 83%;
            margin-top: -0%;
            margin-right: -1.8%;
            padding: 2%;
            width: 22%;
        }
        div.brancoCenter{
            float: left;
            color: black;
            font-family: nunito;
            height: 83%;
            margin-top: -0%;
            margin-right: -1.8%;
            padding: 2%;
            width: 22%;
        }

        p.negrito{
            font-family: Nunito;
            font-weight: 800;
        }

        p.branc{
            font-family: Nunito;
            font-weight: 500;
            margin-top: -3%;
        }

        p.nome{
            font-weight: bold;
            font-family: Nunito;
            font-size: 130%;
        }

        a.editar{
            color: #F3BD1D;
            text-decoration: none;
        }

        a.excluir{
            color: #F24405;
            text-decoration: none;
            margin-left: 40%;
            float: right;
        }

        img.perfil{
            border-radius: 50%;
            width: 30%;
            border-color: linear-gradient(270deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);;
        }

        a.sair{
            color: black;
            text-decoration: none;
        }
</style>
</head>
<body>
    <div class="navbar">
        <br><br><br><br>
    </div>

    <a href="principalProfessor.php"><img  class="casa" src="../img/casa.png"></a>
   <img class="casa1" src="../img/logo.png">
   <img class="casa2" src="../img/perfil.jpeg">

   <!-- Se o <aside> for retirado, a página desconfigura (penso que seja melhor encontrar outro metodo de organizar) --> 
   
   <aside>
        <div class="brancoLeft">
            <?php
                if($vetorTurmas){
                    foreach($vetorTurmas as $turma){
                        echo "<a href='turma.php?id=".$turma["idturma"]."'>Turma ".$turma["nome"]."</a><br><br>";
                    }
                } else
                    echo "Clique no botão para criar uma turma <br><br>";
            ?>
            <p><a href="cadastroTurma.php">(Botão para criar turma)</a></p>
        </div>
    </aside>
    <aside>
        <div class="brancoCenter">
            <center>
                <h3>Conjuntos de Questões</h3>
                <?php
                    if($vetorConjuntos){
                        foreach($vetorConjuntos as $conjunto){
                            echo "<a href='conjunto.php?id=".$conjunto["idconjuntoQuestoes"]."'>".
                                    $conjunto["nome"].
                                "</a> ";
                        }
                    } else
                        echo "Clique no botão para criar um conjunto de questões <br><br>";
                ?>
                <p><a href="cadastroConjunto.php">(Botão para criar conjunto)</a></p>
            </center>
        </div>
    </aside>

    <div class="branco">

      <center><img src="../img/perfil.jpeg" class="perfil"></center>
     


          <center><p class="nome"><?php echo $_SESSION["nome"]." ".$_SESSION["sobrenome"];  ?></p></center>
    <p class="negr"><b>Área de atuação</b></p>
    <p class="branc"><?php echo $_SESSION["areaAtuacao"]; ?></p>
    <p  class="negr"><b>Formação</b></p>
    <p class="branc"><?php echo $_SESSION["formacao"]; ?></p>
    <p  class="negr"><b>E-mail</b></p>
    <p class="branc"><?php echo $_SESSION["email"]; ?></p>
    <p>
        <b>
            <a class="editar" href="cadastroProfessor.php?acao=editar&id=<?php echo $_SESSION["idprofessor"]; ?>">Editar</a> 
            <a class="excluir" href="javascript:excluirRegistro('../control/ctrl_professor.php?acao=excluir&id=<?php echo $_SESSION["idprofessor"]; ?>')">Excluir</a>
        </b>
    </p>
    <br><br><br>
    <hr>
    <center><p><b><a class="sair" href="javascript:sairSistema('../control/ctrl_professor.php?acao=deslogar')"><p class="nome">Sair</p></a></b></p></center>
    </div>
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