<?php
    session_start();

    require_once("../autoload.php");

    require("../utils.php");
    $vetor = listaProfessor($_SESSION["usuario"]);

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    if($acao == "salvar"){
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $sobrenome = isset($_POST["sobrenome"]) ? $_POST["sobrenome"] : "";
        $genero = isset($_POST["genero"]) ? $_POST["genero"] : "";
        $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : "";
        $aluno = new Aluno($id, $nome, $sobrenome, $genero, $etapa, 0, 0, 0.0, $vetor[0]["idprofessor"], $idTurma);
        if($id == 0){
            try{
                $aluno->insere();
                header("location:../professor/turma.php?id=".$idTurma);
            } catch(Exception $e){
                echo "Erro ao cadastrar aluno <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $aluno->editar();
                header("location:../professor/aluno.php?id=".$id);
            } catch(Exception $e){
                echo "Erro ao editar os dados do aluno <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
    } else if($acao == "excluir"){
        try{
            $aluno = new Aluno($id, 1, 1, 1, 1, 1, 1, 1, 1, 1);
            $aluno->excluir();
            header("location:../professor/turma.php?id=".$idTurma);
        } catch(Exception $e){
            echo "Erro ao excluir aluno <br>".
                "<br>".
                $e->getMessage();
        }
    } else if($acao == "deslogar"){
        $prof = Professor::finalizarLogin();
        // session_destroy();
        header("location:../inicial.html");
    }
?>