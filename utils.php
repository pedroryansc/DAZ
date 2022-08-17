<?php
    require_once("autoload.php");

    function listaProfessor($id){
        $prof = new Professor(1, 1, 1, 1, 1, 1, 1);
        $vetor = $prof->listar($id);
        return $vetor;
    }
?>