<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login (Aluno) | DAZ</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <a href="../inicial.html"><img class="icon1" src="../img/img2.png"></img></a><br>
    <br>
    <div class="branco">
    <center>
        <img src="../img/logod.svg" class="logod">
        <form action="../control/ctrl_aluno.php" method="post">
            <input type="text" name="id" placeholder="CÓDIGO" class="logalu"><br>
            <br>
            <button type="submit" name="acao" value="login">
            ▶
            </button>
        </form>
    </center>
</div>
</body>
</html>