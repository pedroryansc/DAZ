<?php
    session_start();

    require_once("../autoload.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    if($acao == "salvar"){
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $tags = isset($_POST["tags"]) ? $_POST["tags"] : "";
        $imagem = isset($_FILES["imagem"]) ? $_FILES["imagem"] : NULL;

        if($imagem["name"] <> "")
            $nomeImagem = $imagem["name"];
        else{
            if($id == 0)
                $nomeImagem = "";
            else{
                $vetorImagemConjunto = Conjunto::listar(2, $id);
                $nomeImagem = $vetorImagemConjunto[0]["imagem"];
            }
        }

        $conjunto = new Conjunto($id, $nome, $tags, $nomeImagem, $_SESSION["idprofessor"]);
        
        if($id == 0){
            try{
                $conjunto->insere();

                Conjunto::insereImagem($id, "conjunto", $imagem);

                if($idTurma == 0)
                    header("location:../professor/principalProfessor.php");
                else
                    header("location:../professor/turma.php?id=".$idTurma);
            } catch(Exception $e){
                echo "Erro ao cadastrar o conjunto de questões <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $conjunto->editar();

                Conjunto::insereImagem($id, "conjunto", $imagem);

                if($idTurma <> 0)
                   $id .= "&idTurma=".$idTurma;
                header("location:../professor/conjunto.php?id=".$id);
            } catch(Exception $e){
                echo "Erro ao editar os dados do conjunto de questões <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
    } else if($acao == "excluir"){
        try{
            $vetorQuestoes = Questao::listar(1, $id);
            foreach($vetorQuestoes as $questao){
                QuestaoAluno::excluir(1, $questao["idquestao"]);
                Alternativas::excluir($questao["idquestao"]);
                Questao::excluir($questao["idquestao"]);
            }
            ConjuntoTurma::excluir(1, $id);
            Conjunto::excluir($id);

            $diretorio = "../img/conjunto/".$id;
            Conjunto::excluiDiretorio($diretorio);

            if($idTurma == 0)
                header("location:../professor/principalProfessor.php");
            else
                header("location:../professor/turma.php?id=".$idTurma);
        } catch(Exception $e){
            echo "Erro ao excluir conjunto de questões <br>".
                "<br>".
                $e->getMessage();
        }
    }
?>