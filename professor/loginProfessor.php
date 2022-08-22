<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login (Professor) - DAZ</title>
</head>
<body>
    <a href="../inicial.html">Voltar</a><br>
    <br><br>
    <form action="../control/ctrl_professor.php" method="post">
        <input type="text" name="email" placeholder="E-mail"><br>
        <br>
        <input type="password" name="senha" placeholder="Senha"><br>
        <p>Não tem uma conta? <a href="cadastroProfessor.php">Clique aqui</a></p>
        <button type="submit" name="acao" value="login">Entrar</button>
    </form>
</body>
</html>