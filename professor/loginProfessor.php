<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style2.css">
    <title>Login (Professor) | DAZ</title>
</head>
<body>
    <a href="../inicial.html"><img src="../img/img2.png"></img></a><br>
       <div class="losub"> <img src="../img/fulllogo.png"></div>
        <form action="../control/ctrl_professor.php" method="post">
            <input type="text" name="email" placeholder="E-mail" class="email"><br>
            <br>
            <input type="password" name="senha" placeholder="Senha" class="senha"><br>
                <p>Não tem uma conta? <a href="cadastroProfessor.php">Clique aqui</a></p>
                <button type="submit" name="acao" value="login">▶</button>
        </form>
</body>
</html>