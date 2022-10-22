<?php
    session_start();

    require_once("../autoload.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idConjunto = isset($_GET["idConjunto"]) ? $_GET["idConjunto"] : 0;

    if($acao == "salvar"){
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
        $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
        $enunciado = isset($_POST["enunciado"]) ? $_POST["enunciado"] : "";
        $tags = isset($_POST["tags"]) ? $_POST["tags"] : "";
        $questao = new Questao($id, $titulo, $tipo, $enunciado, $tags, $_SESSION["idprofessor"], $idConjunto);
        if($id == 0){
            try{
                $questao->insere();
                header("location:../professor/conjunto.php?id=".$idConjunto);
            } catch(Exception $e){
                echo "Erro ao cadastrar a questão <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $questao->editar();
                header("location:../professor/conjunto.php?id=".$idConjunto);
            } catch(Exception $e){
                echo "Erro ao editar os dados da questão <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
    } else if($acao == "excluir"){
        try{
            // Questao::excluir($id);
        } catch(Exception $e){
            echo "Erro ao excluir questão".
                "<br>".
                $e->getMessage();
        }
    }
?>