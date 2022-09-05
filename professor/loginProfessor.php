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
            width: 98%;
            height: 110%;
            background: linear-gradient(180deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);
            overflow-y: hidden;
        } 
        fieldset{
            padding-left: 35%;
            padding-right:35%;
            background-color: transparent;
            border-color: transparent;
        }
        .input1{
            font-weight: bold;
            width: 100%;
            height: 4%;
            margin-bottom: 2%;
            background: #EFF0F3;
            border-radius: 10px;
            border-color: transparent;
            padding-left: 3%;
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 800;
            font-size: 125%;
        }
        .input2{
            font-weight: bold;
            width: 100%;
            height: 4%;
            background: #EFF0F3;
            border-radius: 10px;
            border-color: transparent;
            padding-left: 3%;
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 800;
            font-size: 125%;
        } 
        button{
            margin-top: 1%;
            width: 50%;
            height: 50PX;
            margin-bottom: 20.7%;

            background: white;
            border-radius: 10px;
            border-color: transparent;
        }
        img.daz{
            margin-top: 13%;
            width: 90%;
            margin-left: 6%;
            margin-bottom: 25%;
        }
        a{
            color: black;
        }
        p{
            margin-top: 5%;   

            font-weight: bold;
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 800;
            font-size: 125%;

            color: #272343;
        }
        img.icon{
            margin-top: 1.5%;
            height: 80%;
            width: 15%;
        }
        img.icon1{
            height: 4%;
            width: 4%;
            margin-left: 3%;
            margin-top:2%;
        }
    </style>
</head>
<body>
    <a href="../inicial.html"><img class="icon1" src="../img/img2.png"></img></a><br>
    <!-- <br><br> -->
    <fieldset>
        <img class="daz" src="../img/fulllogo.png">
        <form action="../control/ctrl_professor.php" method="post">
            <input type="text" class="input1" name="email" placeholder="E-mail"><br>
            <br>
            <input type="password" class="input2" name="senha" placeholder="Senha"><br>
            <center>
                <p>Não tem uma conta? <a href="cadastroProfessor.php">Clique aqui</a></p>
            </center>
            <center>
                <button type="submit" name="acao" value="login">
                    <a><img class="icon" src="../img/img1.png"></img></a>
                </button>
            </center>
        </form>
    </fieldset>
</body>
</html>