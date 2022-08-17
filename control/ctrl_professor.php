<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";

    if($acao == "salvar"){
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $sobrenome = isset($_POST["sobrenome"]) ? $_POST["sobrenome"] : "";
        $areaAtuacao = isset($_POST["areaAtuacao"]) ? $_POST["areaAtuacao"] : "";
        $formacao = isset($_POST["formacao"]) ? $_POST["formacao"] : "";
        $confirmarSenha = isset($_POST["confirmarSenha"]) ? $_POST["confirmarSenha"] : "";
        if($senha == $confirmarSenha){
            $prof = new Professor($id, $nome, $sobrenome, $areaAtuacao, $formacao, $email, $senha);
            if($id == 0){
                try{
                    $prof->insere();
                } catch(Exception $e){
                    echo "Erro ao cadastrar professor <br>".
                        "<br>".
                        $e->getMessage();
                }
                header("location:../index/professor/loginProfessor.php");
            } else{
                try{
                    $prof->editar();
                } catch(Exception $e){
                    echo "Erro ao editar dados do professor <br>".
                        "<br>".
                        $e->getMessage();
                }
            }
        } else
            header("location:../index/professor/cadastroProfessor.php");
    } else if($acao == "login"){
        $prof = new Professor(1, 1, 1, 1, 1, 1, 1);
        $login = $prof->efetuaLogin($email, $senha);
        if($login == 0)
            header("location:../index/professor/principalProfessor.php");
        else
            header("location:../index/professor/loginProfessor.php");
    }
?>