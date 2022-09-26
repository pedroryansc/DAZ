<?php
    require_once("autoload.php");

    function listaProfessor($nome){
        $prof = new Professor(1, 1, 1, 1, 1, 1, 1);
        $vetor = $prof->listarNomes($nome);
        return $vetor;
    }

    function listaTurma($id){
        $turma = new Turma(1, 1, 1, 1, 1);
        $vetor = $turma->listar($id);
        return $vetor;
    }
?>