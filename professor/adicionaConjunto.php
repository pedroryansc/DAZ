<!DOCTYPE html>
<?php
    require("../utils.php");

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorTurma = lista("Turma", 2, $idTurma);
    $vetorConjuntos = lista("Conjunto", 1, $_SESSION["idprofessor"]);

    $string = "";
    $cont = 0;
    if($vetorConjuntos){
        foreach($vetorConjuntos as $conjunto){
            $string .= "<input type='checkbox' name='idConjunto".$cont."' value='".$conjunto['idconjuntoQuestoes']."'><br>".
                        $conjunto["nome"]."<br><br>";
            $cont ++;
        }
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Conjunto (<?php echo $vetorTurma[0]["nome"] ?>) | DAZ</title>
</head>
<body>
    <br>
    <center>
        <?php
            if($vetorConjuntos){
        ?>
        <form action="../control/ctrl_conjuntoTurma.php?idTurma=<?php echo $idTurma; ?>&cont=<?php echo $cont; ?>" method="post">
            <p>Selecione os conjuntos que deseja adicionar:</p>
            <?php
                echo $string;
            ?>
            <button type="submit" name="acao" value="salvar">Adicionar</button>
        </form>
        <?php
            } else{
        ?>
        <p>Clique no botão abaixo para cadastrar um conjunto de questões:</p>
        <a href="cadastroConjunto.php?idTurma=<?php echo $idTurma; ?>">(Botão para criar conjunto)</a>
        <?php
            }
        ?>
    </center>
</body>
</html>