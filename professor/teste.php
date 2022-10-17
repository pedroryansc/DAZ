<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="imagem"><br>
        <br>
        <button type="submit" name="acao" value="enviar">Enviar</button>
    </form>
    <?php
        $imagem = isset($_FILES["imagem"]) ? $_FILES["imagem"] : null;
        $destino = "../img/".date("Hisms").".png";
        if(isset($_FILES["imagem"])){
            move_uploaded_file($imagem["tmp_name"], $destino);
            echo "<img src=".$destino.">";
        }
    ?>
</body>
</html>