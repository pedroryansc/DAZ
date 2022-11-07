<!DOCTYPE html>
<?php
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    if($acao == "editar"){
        session_start();
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style3.css">
    <title>Cadastro | DAZ</title>
</head>
<body>
    <a href="<?php if($acao == "editar") echo "principalProfessor.php"; else echo "loginProfessor.php"; ?>"><img class="icon1" src="../img/img3.png"></img></a><br>
    <a href="" class="voltar"><img src="img\flecha.svg" alt="" srcset=""></a>
            <form action="../control/ctrl_professor.php<?php if($acao == "editar") echo "?id=".$_SESSION["idprofessor"]; ?>" method="post" enctype="multipart/form-data">
                <!--
                    (Pesquisar pela função de criar uma pasta automaticamente. A pasta serviria para armazenar as imagens do usuário)
                    
                    Foto de perfil
-->
                <input type="file" name="fotoPerfil" class="foto"><br>
                <br>
                <input type="text" name="nome" placeholder="Nome"
                value="<?php if($acao == "editar") echo $_SESSION["nome"]; ?>"class="nome">

                <input type="text" name="sobrenome" placeholder="Sobrenome"
                value="<?php if($acao == "editar") echo $_SESSION["sobrenome"]; ?>" class="sobrenome">

                <input type="text" name="areaAtuacao" placeholder="Área de atuação"
                value="<?php if($acao == "editar") echo $_SESSION["areaAtuacao"]; ?>" class="area">

                <input type="text" name="formacao" placeholder="Formação"
                value="<?php if($acao == "editar") echo $_SESSION["formacao"]; ?>" class="forma">

                <input type="text" name="email" placeholder="E-mail"
                value="<?php if($acao == "editar") echo $_SESSION["email"]; ?>" class="email">

                <input type="password" name="senha" placeholder="Senha"
                value="<?php if($acao == "editar") echo $_SESSION["senha"]; ?>"class="senha">

                <input type="password" name="confirmarSenha" placeholder="Confirme sua senha" class="confirmacao">

                <button type="submit" name="acao" value="salvar">▶</button>
            </form>
            <div class="degra"></div>
            <img src="../img/logoesub.svg" alt="" class="logo">
</body>
</html>