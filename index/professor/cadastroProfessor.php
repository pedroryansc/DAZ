<!DOCTYPE html>
<?php
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro (Professor) - DAZ</title>
</head>
<body>
    <a href="loginProfessor.php">Voltar</a><br>
    <br><br>
    <form action="../../control/ctrl_professor.php?id=<?php echo $id; ?>" method="post">
        <!-- <input type="file" name="imagem"><br>
        <br> -->
        <input type="text" name="nome" placeholder="Nome"><br>
        <br>
        <input type="text" name="sobrenome" placeholder="Sobrenome"><br>
        <br>
        <input type="text" name="areaAtuacao" placeholder="Área de atuação"><br>
        <br>
        <input type="text" name="formacao" placeholder="Formação"><br>
        <br>
        <input type="text" name="email" placeholder="E-mail"><br>
        <br>
        <input type="password" name="senha" placeholder="Senha"><br>
        <br>
        <input type="password" name="confirmarSenha" placeholder="Confirme sua senha"><br>
        <br>
        <button type="submit" name="acao" value="salvar">Salvar</button>
    </form>
</body>
</html>