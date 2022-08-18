<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $vetor = listaProfessor($id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal (Professor) -  DAZ</title>
</head>
<body>
    <a href="principalProfessor?id=<?php echo $id; ?>.php">(Home)</a><br>
    <p>Prof. <?php echo $vetor[0]["nome"]." ".$vetor[0]["sobrenome"];  ?></p>
</body>
</html>