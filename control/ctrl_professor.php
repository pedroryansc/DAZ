<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";

    if($acao == "salvar"){
        /**
         * var_dump($_FILES);
         * die();
         * $fotoPerfil = isset($_FILES["fotoPerfil"]) ? $_FILES["fotoPerfil"] : null;
         * 
         * (Sugestão: Fazer verificação da extensão do arquivo)
         * 
         * Mover arquivo:
         * 
         * $destino = "../imagens/".$_FILES["arquivo"]["name"];
         * move_uploaded_file($arquivo["tmp_name"], $destino);
         */
        $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : null;
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
                header("location:../professor/loginProfessor.php");
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
            header("location:../professor/cadastroProfessor.php");
    } else if($acao == "login"){
        $prof = new Professor(1, 1, 1, 1, 1, 1, 1);
        $login = $prof->efetuaLogin($email, $senha);
        if(count($login) == 1)
            header("location:../professor/principalProfessor.php?id=".$login[0]["idprofessor"]);
        else
            header("location:../professor/loginProfessor.php");
    }
?>