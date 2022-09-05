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
    <title>Cadastro (Professor) - DAZ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');

        .input1{
            position: absolute;
            width: 465.8px;
            height: 50px;
            left: 106px;
            top: 512px;

            background: #D9D9D9;
            border-radius: 10px;
            border-color: #D9D9D9;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px;
        }
        .input2{
            position: absolute;
            width: 465.8px;
            height: 50px;
            left: 106px;
            top: 584px;

            background: #D9D9D9;
            border-radius: 10px;
            border-color: #D9D9D9; 

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px;
        }
        .input3{
            position: absolute;
            width: 459.24px;
            height: 50px;
            left: 106px;
            top: 656px;

            background: #D9D9D9;
            border-radius: 10px;
            border-color: #D9D9D9;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px;
        }
        .input4{
            position: absolute;
            width: 459.24px;
            height: 50px;
            left: 106px;
            top: 728px;
            
            background: #D9D9D9;
            border-radius: 10px;
            border-color: #D9D9D9;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px;
        }
        .input5{
            position: absolute;
            width: 459.24px;
            height: 50px;
            left: 106px;
            top: 800px;

            background: #D9D9D9;
            border-radius: 10px;
            border-color: #D9D9D9;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px;
        }
        .input6{
            position: absolute;
            width: 459.24px;
            height: 50px;
            left: 106px;
            top: 800px;

            background: #D9D9D9;
            border-radius: 10px;
            border-color: #D9D9D9;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px
        }
        .input7{
            position: absolute;
            width: 459.24px;
            height: 50px;
            left: 106px;
            top: 872px;

            background: #D9D9D9;
            border-radius: 10px;
            border-color: #D9D9D9;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px
        }
        button{
            position: absolute;
            width: 280px;
            height: 50px;
            left: 196px;
            top: 944px;

            background: linear-gradient(267.77deg, #BDBE6E 7.05%, #F3BD1D 49.14%, #BAD9C9 89.52%);
            border-radius: 10px;
            border-color: #D9D9D9;
            border-color: #FFFFFE;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 200;
            font-size: 20px;
            line-height: 23px;
        }
        body{
            background: linear-gradient(270deg, #BDBE6E 6.17%, #F3BD1D 48.36%, #BAD9C9 87.94%);
        }
        .branco{
            position: absolute;
            width: 668px;
            height: 1024px;
            left: 0px;
            top: 0px;

            background: #FFFFFE;
        }
        .img1{
            position: absolute;
            width: 1024px;
            height: 504px;
            left: 1172px;
            top: 0px;

            transform: rotate(90deg);
        }
        .img2{
            position: absolute;
            width: 1024px;
            height: 38px;
            left: 1308px;
            top: 0px;

            transform: rotate(90deg);
        }
        .voltar{
            box-sizing: border-box;

            position: absolute;
            width: 55px;
            height: 0px;
            left: 85px;
            top: 51px;

            border: 7px solid #BDBE6E;
            transform: rotate(180deg);
        }
        .volta{
            box-sizing: border-box;

            position: absolute;
            width: 55px;
            height: 0px;
            left: 85px;
            top: 51px;

            border: 7px solid #BDBE6E;
            transform: rotate(180deg);
        }
        .perfil{
            position: absolute;
            width: 338px;
            height: 338px;
            left: 170px;
            top: 97px;

            background: conic-gradient(from 180deg at 50% 50%, #BAD9C9 0deg, #BDBE6E 15deg, #F3BD1D 200.63deg, #BAD9C9 360deg);
        }
    </style>
</head>
<body>
    <div class="branco">
        <div class="volta"></div>
        <a href="<?php if($acao == "editar") echo "principalProfessor.php"; else echo "loginProfessor.php"; ?>" class="voltar">
            <img src="../img/flecha.svg" alt="" srcset="">
        </a>
        <br><br><br>
        <div class="perfil">
            <form action="../control/ctrl_professor.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <!--
                    (Pesquisar pela função de criar uma pasta automaticamente. A pasta serviria para armazenar as imagens do usuário)

                    Foto de perfil
                    <input type="file" name="imagem"><br>
                    <br>
                -->
                <input type="text" class="input1" name="nome" placeholder="Nome"
                value="<?php if($acao == "editar") echo $vetor[0]["nome"]; ?>"><br>
                <br>
                <input type="text" class="input2" name="sobrenome" placeholder="Sobrenome"
                value="<?php if($acao == "editar") echo $vetor[0]["sobrenome"]; ?>"><br>
                <br>
                <input type="text" class="input3" name="areaAtuacao" placeholder="Área de atuação"
                value="<?php if($acao == "editar") echo $vetor[0]["areaAtuacao"]; ?>"><br>
                <br>
                <input type="text" class="input4" name="formacao" placeholder="Formação"
                value="<?php if($acao == "editar") echo $vetor[0]["formacao"]; ?>"><br>
                <br>
                <input type="text" class="input5" name="email" placeholder="E-mail"
                value="<?php if($acao == "editar") echo $vetor[0]["email"]; ?>"><br>
                <br>
                <input type="password" class="input6" name="senha" placeholder="Senha"
                value="<?php if($acao == "editar") echo $vetor[0]["senha"]; ?>"><br>
                <br>
                <input type="password" class="input7" name="confirmarSenha" placeholder="Confirme sua senha"><br>
                <br>
                <button type="submit" name="acao" value="salvar">Salvar</button>
            </form>
            <div></div>
        </div>
        <img src="../img/Frame3.svg" class="img1">
        <img src="../img/PLATAFORMA PARA ALFABETIZAÇÃO DE JOVENS E ADULTOS.svg" alt="" srcset="" class="img2">
    </div>
</body>
</html>