<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idConjunto = isset($_GET["idConjunto"]) ? $_GET["idConjunto"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorConjunto = lista("Conjunto", 2, $idConjunto);
    $vetorQuestao = lista("Questao", 2, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Questão | DAZ</title>
</head>
<body>
    <a href="principalProfessor.php">(Home)</a><br>
    <br>
    <a href="conjunto.php?id=<?php echo $idConjunto; ?>">(Voltar)</a>
    <h2>Conjunto de Questões <?php echo $vetorConjunto[0]["nome"]; ?></h2>
    <form action="../control/ctrl_questao.php?id=<?php echo $id; ?>&idConjunto=<?php echo $idConjunto; ?>" method="post">
        <input type="text" name="titulo" value="" placeholder="Digite o título da questão">
        <button type="submit" name="acao" value="salvar">Salvar</button><br>
        <br>
        Objetiva <input type="radio" name="tipo" value="1" <?php  ?>><br>
        Dissertativa <input type="radio" name="tipo" value="2" <?php ?>><br>
        <br>
        <input type="text" name="enunciado" size="40" value="" placeholder="Digite o enunciado"><br>
        <br>
        <?php
            for($i = 1; $i <= 4; $i ++){
        ?>
            <input type="text" name="alternativa<?php echo $i; ?>" size="40" value="" placeholder="Digite a alternativa <?php echo $i; ?>"><br>
            <input type="text" name="explicacao<?php echo $i; ?>" size="40" value="" placeholder="Explicação"><br>
            <br>
        <?php
            }
        ?>
        <p>Tags:</p>
        <input type="text" name="tags" value="">
    </form>
</body>
</html>