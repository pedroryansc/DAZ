<?php
    session_start();

    require_once("../autoload.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";

    if($acao == "salvar"){
        var_dump($_FILES);
        die();
        /* $fotoPerfil = isset($_FILES["fotoPerfil"]) ? $_FILES["fotoPerfil"] : null;
        
        (Sugestão: Fazer verificação da extensão do arquivo)
        
        Mover arquivo:
        
        $destino = "../imagens/".$_FILES["arquivo"]["name"];
        move_uploaded_file($arquivo["tmp_name"], $destino);
        
        */
        $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : null;
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $sobrenome = isset($_POST["sobrenome"]) ? $_POST["sobrenome"] : "";
        $areaAtuacao = isset($_POST["areaAtuacao"]) ? $_POST["areaAtuacao"] : "";
        $formacao = isset($_POST["formacao"]) ? $_POST["formacao"] : "";
        /*
        $fotoPerfil = isset($_FILES["fotoPerfil"]) ? $_FILES["fotoPerfil"] : null;
        echo $fotoPerfil;
        */
        $confirmarSenha = isset($_POST["confirmarSenha"]) ? $_POST["confirmarSenha"] : "";
        if($senha == $confirmarSenha){
            $prof = new Professor($id, $nome, $sobrenome, $areaAtuacao, $formacao, $email, $senha/*, $fotoPerfil */);
            if($id == 0){
                try{
                    $prof->insere();
                    header("location:../professor/loginProfessor.php");
                } catch(Exception $e){
                    echo "Erro ao cadastrar professor <br>".
                        "<br>".
                        $e->getMessage();
                }
            } else{
                try{
                    $prof->editar();
                    $prof->efetuaLogin($email, $senha);
                    header("location:../professor/principalProfessor.php");
                } catch(Exception $e){
                    echo "Erro ao editar dados do professor <br>".
                        "<br>".
                        $e->getMessage();
                }
            }
        } else
            if($id == 0)
                header("location:../professor/cadastroProfessor.php");
            else
                header("location:../professor/cadastroProfessor.php?acao=editar&id=".$id);
    } else if($acao == "excluir"){
        try{
            $vetorTurmas = Turma::listar(1, $id);
            foreach($vetorTurmas as $turma){
                $vetorAlunos = Aluno::listar(1, $turma["idturma"]);
                foreach($vetorAlunos as $aluno){
                    QuestaoAluno::excluir(2, $aluno["idaluno"]);
                    Aluno::excluir($aluno["idaluno"]);
                }
                ConjuntoTurma::excluir(2, $turma["idturma"]);
                Turma::excluir($turma["idturma"]);
            }
            $vetorConjuntos = Conjunto::listar(1, $id);
            foreach($vetorConjuntos as $conjunto){
                $vetorQuestoes = Questao::listar(1, $conjunto["idconjuntoQuestoes"]);
                foreach($vetorQuestoes as $questao){
                    if($questao["tipo"] == 1)
                        Alternativas::excluir($questao["idquestao"]);
                    Questao::excluir($questao["idquestao"]);
                }
                Conjunto::excluir($conjunto["idconjuntoQuestoes"]);
            }
            Professor::excluir($id);
            Professor::finalizarLogin();
            // session_destroy();
            header("location:../inicial.html");
        } catch(Exception $e){
            echo "Erro ao excluir cadastro <br>".
                "<br>".
                $e->getMessage();
        }
    } else if($acao == "login"){
        $prof = Professor::efetuaLogin($email, $senha);
        if($prof)
            header("location:../professor/principalProfessor.php");
        else
            header("location:../professor/loginProfessor.php");
    } else if($acao == "deslogar"){
        $prof = Professor::finalizarLogin();
        // session_destroy();
        header("location:../inicial.html");
    }
?>