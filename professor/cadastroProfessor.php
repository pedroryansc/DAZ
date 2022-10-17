<!DOCTYPE html>
<?php
    require("../utils.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "editar"){
        session_start();
        $vetor = listaProfessor($_SESSION['usuario']);
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro (Professor) | DAZ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');

        .input1{
            width: 65%;
            margin-bottom: 1.5%;
            height: 30px;
            background: #D9D9D9;
            border-radius: 5px;
            border-color: transparent;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            padding-left: 1.5%;
        }

        .input2{ 
            width: 65%;
            margin-bottom: 1.5%;
            height: 30px;

            background: #D9D9D9;
            border-radius: 5px;
            border-color: transparent; 
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            padding-left: 1.5%;
        }

        .input3{         
            width: 65%;
            margin-bottom: 1.5%;
            height: 30px;

            background: #D9D9D9;
            border-radius: 5px;
            border-color: transparent;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            padding-left: 1.5%;
        }

        .input4{        
            width: 65%;
            margin-bottom: 1.5%;
            height: 30px;

            background: #D9D9D9;
            border-radius: 5px;
            border-color: transparent;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            padding-left: 1.5%;
        }

        .input5{  
            width: 65%;
            margin-bottom: 1.5%;
            height: 30px;

            background: #D9D9D9;
            border-radius: 5px;
            border-color: transparent;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            padding-left: 1.5%;
        }

        .input6{           
            width: 65%;
            margin-bottom: 1.5%;
            height: 30px;

            background: #D9D9D9;
            border-radius: 5px;
            border-color: transparent;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            padding-left: 1.5%;
        }

        .input7{          
            width: 65%;
            margin-bottom: 1.5%;
            height: 30px;

            background: #D9D9D9;
            border-radius: 5px;
            border-color: transparent;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            padding-left: 1.5%; 
        }

        button{
            margin-top: 1%;
            width: 45%;
            height: 35px;

            background: #BAD9C9;
            border-radius: 5px;
            border-color: transparent;
        }

        body{
            background: linear-gradient(270deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);
            margin: 0;
            padding: 0;
        }

        .branco{
            width: 45%;
            height: 656px;
            left: 0px;
            top: 0px;
            background: #FFFFFE;
        }

        img.icon{
            margin-top: 1.5%;
            height: 80%;
            width: 10%;
        }

        img.icon1{
            height: 8%;
            width: 8%;
            margin-left: 3%;
            margin-top:2%;
        }

        img.perfil{
            border-radius: 50%;
            width: 30%;
            margin-top: -7%;
            border-color: linear-gradient(270deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);;
        }

        div.perfil{
            background: linear-gradient(270deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);
            width: 32%;
            height: 198px;
            margin-top: -31.8%;
            color: transparent;
            border-radius: 50%;
            margin-bottom: 3%;
        }

        .img1{           
            position: absolute;
            width: 24.6%;
            margin-top: -50%;
            margin-left: 44.8%;
            transform: rotate(360deg);
        }

        .img2{   
            position: absolute;   
            margin-left: 95%;  
            margin-top: -48%;
            width: 1.78%;
            transform: rotate(360deg);
        }
    </style>
</head>
<body>
    <div class="branco">

     <a href="loginProfessor.php"><img class="icon1" src="../img/img3.png"></img></a><br>
    <div class="volta"></div>
    <a href="<?php if($acao == "editar") echo "principalProfessor.php"; else echo "loginProfessor.php"; ?>" class="voltar"><img src="img\flecha.svg" alt="" srcset=""></a>
        <center>
            <img src="../img/perfil.jpeg" class="perfil">
        </center>
        <center>
            <div class="perfil"></div>
        </center>
        <center>
            <form action="../control/ctrl_professor.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <!--
                    (Pesquisar pela função de criar uma pasta automaticamente. A pasta serviria para armazenar as imagens do usuário)
                    
                    Foto de perfil
                    <input type="file" name="imagem"><br>
                    <br>
                -->
                <input type="text" class="input1" name="nome" placeholder="Nome"
                value="<?php if($acao == "editar") echo $vetor[0]["nome"]; ?>">

                <input type="text" class="input2" name="sobrenome" placeholder="Sobrenome"
                value="<?php if($acao == "editar") echo $vetor[0]["sobrenome"]; ?>">

                <input type="text" class="input3" name="areaAtuacao" placeholder="Área de atuação"
                value="<?php if($acao == "editar") echo $vetor[0]["areaAtuacao"]; ?>">

                <input type="text" class="input4" name="formacao" placeholder="Formação"
                value="<?php if($acao == "editar") echo $vetor[0]["formacao"]; ?>">

                <input type="text" class="input5" name="email" placeholder="E-mail"
                value="<?php if($acao == "editar") echo $vetor[0]["email"]; ?>">

                <input type="password" class="input6" name="senha" placeholder="Senha"
                value="<?php if($acao == "editar") echo $vetor[0]["senha"]; ?>">

                <input type="password" class="input7" name="confirmarSenha" placeholder="Confirme sua senha">

                <button type="submit" name="acao" value="salvar">
                    <a><img src="../img/img1.png" class="icon"></img></a>
                </button>
            </form>
        </center>
    </div>
    <img src="../img/Frame3.svg" class="img1">
    <img src="../img/PLATAFORMA PARA ALFABETIZAÇÃO DE JOVENS E ADULTOS.svg" alt="" srcset="" class="img2">
</body>
</html>