<?php
    session_start();

    require_once("../autoload.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "salvar"){
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $instituicao = isset($_POST["instituicao"]) ? $_POST["instituicao"] : "";
        $turma = new Turma($id, $nome, $instituicao, 0.0, $_SESSION["idprofessor"]);
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
            $vetorAlunos = Aluno::listar(1, $id);
            foreach($vetorAlunos as $aluno){
                QuestaoAluno::excluir(2, $aluno["idaluno"]);
                Aluno::excluir($aluno["idaluno"]);
            }
            ConjuntoTurma::excluir(2, $id);
            Turma::excluir($id);
            header("location:../professor/principalProfessor.php");
        } catch(Exception $e){
            echo "Erro ao excluir turma <br>".
                "<br>".
                $e->getMessage();
        }
    }
?>