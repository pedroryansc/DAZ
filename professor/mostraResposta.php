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
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respostas | DAZ</title>
</head>
<body>
    <div>
    <?php echo json_decode(include_once("../resp/teste.json"));?>
    </div>
    
</body>
</html>