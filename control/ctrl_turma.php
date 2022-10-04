<?php
    session_start();

    require_once("../autoload.php");

    require("../utils.php");
    $vetor = listaProfessor($_SESSION["usuario"]);

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "salvar"){
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $instituicao = isset($_POST["instituicao"]) ? $_POST["instituicao"] : "";
        $turma = new Turma($id, $nome, $instituicao, 0.0, $vetor[0]["idprofessor"]);
        if($id == 0){
            try{
                $turma->insere();
                header("location:../professor/principalProfessor.php");
            } catch(Exception $e){
                echo "Erro ao cadastrar turma <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $turma->editar();
                header("location:../professor/turma.php?id=".$id);
            } catch(Exception $e){
                echo "Erro ao editar dados da turma <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
    } else if($acao == "excluir"){
        try{
            $turma = new Turma($id, 1, 1, 1, 1);
            $turma->excluir();
            header("location:../professor/principalProfessor.php");
        } catch(Exception $e){
            echo "Erro ao excluir turma <br>".
                "<br>".
                $e->getMessage();
        }
    } else if ($acao == "deslogar"){
        $prof = Professor::finalizarLogin();
        // session_destroy();
        header("location:../inicial.html");
    }
?>