<?php
    require_once("autoload.php");

    function listaProfessor($nome){
        return Professor::listarNomes($nome);
    }

    function listaTurma($tipo, $id){
        return Turma::listar($tipo, $id);
    }

    function listaAluno($tipo, $id){
        return Aluno::listar($tipo, $id);
    }
?>