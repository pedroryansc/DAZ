<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login (Aluno) | DAZ</title>
</head>
<body>
    <a href="../inicial.html">(Botão para voltar)</a><br>
    <br>
    <center>
        <form action="../control/ctrl_aluno.php" method="post">
            <input type="text" name="id" placeholder="CÓDIGO"><br>
            <br>
            <button type="submit" name="acao" value="login">
                Fazer Login
            </button>
        </form>
    </center>
</body>
</html>