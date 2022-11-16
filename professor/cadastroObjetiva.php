<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    $idConjunto = isset($_GET["idConjunto"]) ? $_GET["idConjunto"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");

    $vetorConjunto = lista("Conjunto", 2, $idConjunto);
    if($acao == "editar")
        $vetorQuestao = lista("Questao", 2, $id);
        $vetorAlternativas = lista("Alternativas", 0, $id);

    if($idTurma <> 0)
        $idConjunto .= "&idTurma=".$idTurma;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Questão Objetiva | DAZ</title>
</head>
<body>
    <a href="principalProfessor.php">(Home)</a><br>
    <br>
    <a href="conjunto.php?id=<?php echo $idConjunto; ?>">(Voltar)</a>
    <h2>Conjunto de Questões <?php echo $vetorConjunto[0]["nome"]; ?></h2>
    <form action="../control/ctrl_questao.php?id=<?php echo $id; ?>&idConjunto=<?php echo $idConjunto; ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="titulo" value='<?php if($acao == "editar") echo $vetorQuestao[0]["titulo"]; ?>' placeholder="Digite o título da questão">
        <button type="submit" name="acao" value="salvar">Salvar</button><br>
        <br>
        Objetiva <input type="radio" name="tipo" value="1" <?php echo "checked"; ?>><br>
        Dissertativa <input type="radio" onclick="location.href='cadastroDissertativa.php?<?php if($acao == 'editar') echo 'acao=editar&id='.$id.'&'; ?>idConjunto=<?php echo $idConjunto; ?>'"><br>
        <br>
        <input type="file" name="midia"><br>
        <br>
        <input type="text" name="enunciado" size="40" value='<?php if($acao == "editar") echo $vetorQuestao[0]["enunciado"]; ?>' placeholder="Digite o enunciado"><br>
        <br>
        <?php
            for($i = 1; $i <= 4; $i ++){
        ?>
            <input type="text" name="alt<?php echo $i; ?>" size="40" value='<?php if($acao == "editar" && $vetorQuestao[0]["tipo"] == 1) echo $vetorAlternativas[0]["alternativa".$i]; ?>' placeholder="Digite a alternativa <?php echo $i; ?>">
            <input type="radio" name="altCorreta" value="<?php echo $i; ?>" <?php if($acao == "editar" && $vetorQuestao[0]["tipo"] == 1 && $vetorAlternativas[0]["alternativaCorreta"] == $i) echo "checked"; ?>><br>
            <!-- O input "altCorreta" está à direita, no momento, apenas para os inputs "alt" e "exp" ficarem alinhados -->
            <input type="text" name="exp<?php echo $i; ?>" size="40" value='<?php if($acao == "editar" && $vetorQuestao[0]["tipo"] == 1) echo $vetorAlternativas[0]["explicacao".$i]; ?>' placeholder="Explicação"><br>
            <br>
        <?php
            }
        ?>
        <p>Tags:</p>
        <input type="text" name="tags" value='<?php if($acao == "editar") echo $vetorQuestao[0]["tags"]; ?>'>
    </form>
</body>
</html>