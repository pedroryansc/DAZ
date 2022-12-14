<?php
    session_start();

    require_once("../autoload.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    if(empty($id))
        $id = isset($_POST["id"]) ? $_POST["id"] : 0;

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    if($acao == "salvar"){
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $sobrenome = isset($_POST["sobrenome"]) ? $_POST["sobrenome"] : "";
        $genero = isset($_POST["genero"]) ? $_POST["genero"] : "";
        $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : "";
        $fotoPerfil = isset($_FILES["fotoPerfil"]) ? $_FILES["fotoPerfil"] : NULL;

        if($fotoPerfil["name"] <> "")
            $nomeFotoPerfil = $fotoPerfil["name"];
        else{
            if($id == 0)
                $nomeFotoPerfil = "";
            else{
                $vetorFotoAluno = Aluno::listar(2, $id);
                $nomeFotoPerfil = $vetorFotoAluno[0]["fotoPerfil"];
            }
        }
        
        $aluno = new Aluno($id, $nome, $sobrenome, $genero, $etapa, 0, 0, 0.0, NULL, $nomeFotoPerfil, $_SESSION["idprofessor"], $idTurma);
        
        if($id == 0){
            try{
                $aluno->insere();

                Aluno::insereImagem($id, "aluno", $fotoPerfil);
                
                $vetorAlunos = Aluno::listar(1, $idTurma);
                $somaMedias = 0;
                foreach($vetorAlunos as $aluno){
                    $somaMedias = $somaMedias + $aluno["media"];
                }
                Turma::atualizaMediaGeral($idTurma, $somaMedias, count($vetorAlunos));

                header("location:../professor/turma.php?id=".$idTurma);
            } catch(Exception $e){
                echo "Erro ao cadastrar aluno <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $aluno->editar();

                Aluno::insereImagem($id, "aluno", $fotoPerfil);

                header("location:../professor/aluno.php?id=".$id);
            } catch(Exception $e){
                echo "Erro ao editar os dados do aluno <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
    } else if($acao == "excluir"){
        try{
            QuestaoAluno::excluir(2, $id);
            Aluno::excluir($id);

            $diretorio = "../img/aluno/".$id;
            Aluno::excluiDiretorio($diretorio);

            $vetorAlunos = Aluno::listar(1, $idTurma);
            $somaMedias = 0;
            foreach($vetorAlunos as $aluno){
                $somaMedias = $somaMedias + $aluno["media"];
            }
            Turma::atualizaMediaGeral($idTurma, $somaMedias, count($vetorAlunos));

            header("location:../professor/turma.php?id=".$idTurma);
        } catch(Exception $e){
            echo "Erro ao excluir aluno <br>".
                "<br>".
                $e->getMessage();
        }
    } else if($acao == "login"){
        $aluno = Aluno::efetuaLogin($id);
        if($aluno)
            header("location:../aluno/principalAluno.php");
        else
            header("location:../aluno/loginAluno.php");
    } else if($acao == "deslogar"){
        $aluno = Aluno::finalizarLogin();
        // session_destroy();
        header("location:../inicial.html");
    }
?>