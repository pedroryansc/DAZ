<?php
    session_start();
?>
<!DOCTYPE html>
<?php
    require("../utils.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $vetor = listaProfessor($_SESSION['usuario']);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro (Professor) - DAZ</title>
</head>
<body>
    <a href="<?php if($acao == "editar") echo "principalProfessor.php?id=".$id; else echo "loginProfessor.php"; ?>">Voltar</a><br>
    <br><br>
    <form action="../control/ctrl_professor.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <!--
            (Pesquisar pela função de criar uma pasta automaticamente. A pasta serviria para armazenar as imagens do usuário)

            Foto de perfil
            <input type="file" name="imagem"><br>
            <br>
        -->
        <input type="text" name="nome" placeholder="Nome" value="<?php if($acao == "editar") echo $vetor[0]["nome"]; ?>"><br>
        <br>
        <input type="text" name="sobrenome" placeholder="Sobrenome"
        value="<?php if($acao == "editar") echo $vetor[0]["sobrenome"]; ?>"><br>
        <br>
        <input type="text" name="areaAtuacao" placeholder="Área de atuação"
        value="<?php if($acao == "editar") echo $vetor[0]["areaAtuacao"]; ?>"><br>
        <br>
        <input type="text" name="formacao" placeholder="Formação"
        value="<?php if($acao == "editar") echo $vetor[0]["formacao"]; ?>"><br>
        <br>
        <input type="text" name="email" placeholder="E-mail" value="<?php if($acao == "editar") echo $vetor[0]["email"]; ?>"><br>
        <br>
        <input type="password" name="senha" placeholder="Senha" value="<?php if($acao == "editar") echo $vetor[0]["senha"]; ?>"><br>
        <br>
        <input type="password" name="confirmarSenha" placeholder="Confirme sua senha"><br>
        <br>
        <button type="submit" name="acao" value="salvar">Salvar</button>
    </form>
</body>
</html>