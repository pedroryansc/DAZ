<?php
    require_once("autoload.php");

    function listaProfessor($nome){
        $prof = new Professor(1, 1, 1, 1, 1, 1, 1);
        $vetor = $prof->listarNomes($nome);
        return $vetor;
    }
?>