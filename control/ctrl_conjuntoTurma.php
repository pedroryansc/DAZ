<?php
    session_start();

    require_once("../autoload.php");

    $idConjunto = array();
    $cont = isset($_GET["cont"]) ? $_GET["cont"] : 0;
    for($i = 0; $i < $cont; $i ++){
        $idConjunto[] = isset($_POST["idConjunto".$i]) ? $_POST["idConjunto".$i] : 0;
    }

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    for($i = 0; $i < $cont; $i ++){
        if(isset($_POST["idConjunto".$i])){
            $conjTurma = new ConjuntoTurma($idConjunto[$i], $idTurma);
            $conjTurma->insere();
        }
    }
    header("location:../professor/turma.php?id=".$idTurma);
?>