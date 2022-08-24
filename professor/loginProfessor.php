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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap');
      body{
       
width: 1028px;
height: 1472px;
left: 850x;
top: 1028px;

background: linear-gradient(270deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);

      } 
      .input1{
        position: absolute;
width: 578px;
height: 34px;
left: 850px;
top: 610px;

background: #EFF0F3;
border-radius: 10px;
border-color: #EFF0F3;

font-family: 'Nunito';
font-style: normal;
font-weight: 300;
font-size: 20px;
line-height: 27px;
      }
      .input2{
        position: absolute;
width: 578px;
height: 39px;
left: 850px;
top: 680px;

background: #EFF0F3;
border-radius: 10px;
border-color: #EFF0F3;

font-family: 'Nunito';
font-style: normal;
font-weight: 300;
font-size: 20px;
line-height: 27px;
      } 
      button{
        position: absolute;
width: 280px;
height: 50px;
left: 850px;
top: 809px;

background: linear-gradient(89.94deg, #EDBF2B 0.05%, #BDBE6E 97.46%);
border-radius: 10px;
border-color: #EFF0F3;
      }
      img{
        position: absolute;
width: 516.87px;
height: 253.45px;
left: 850px;
top: 190px;
      }
      p{
        position: absolute;
width: 303px;
height: 20px;
left: 850px;
top: 748px;

font-family: 'Nunito';
font-style: normal;
font-weight: 400;
font-size: 20px;
line-height: 27px;

color: #272343;
      }
      a{
        color: black;
      }
    </style>

</head>
<body>
    <a href="../inicial.html">Voltar</a><br>
    <br><br>
    <center>
    <img src="../img/fulllogo.png">
    <form action="../control/ctrl_professor.php" method="post">
        <input type="text" name="email" placeholder="E-mail" class="input1"><br>
        <br>
        <input type="password" name="senha" placeholder="Senha" class="input2"><br>
        <p>Não tem uma conta? <a href="cadastroProfessor.php">Clique aqui</a></p>
        <button type="submit" name="acao" value="login">Entrar</button>
    </form>
    </center>
</body>
</html>