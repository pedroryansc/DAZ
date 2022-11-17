<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    
    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    session_start();
    if(empty($_SESSION["idprofessor"]))
        header("location:../inicial.html");
    
    if($acao == "editar")
        $vetorAluno = lista("Aluno", 2, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style6.css">
    <title>Cadastro de Aluno | DAZ</title>
</head>
<body>
    <br>
        <div class="branco">
        <form action="../control/ctrl_aluno.php?id=<?php echo $id; ?>&idTurma=<?php echo $idTurma; ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="fotoPerfil" placeholder="Foto" class="file"><br>
            <br>
            <input type="text" name="nome" size="40" value="<?php if($acao == "editar") echo $vetorAluno[0]["nome"]; ?>" placeholder="Nome" class="txt"><br>
            <br>
            <input type="text" name="sobrenome" size="40" value="<?php if($acao == "editar") echo $vetorAluno[0]["sobrenome"]; ?>"placeholder="Sobrenome" class="txt"><br>
            <br>
            <select name="genero">
                <option value="">Genero</option>
                <option value="1" <?php if($acao == "editar" && $vetorAluno[0]["genero"] == "1") echo "selected"; ?>>Feminino</option>
                <option value="2" <?php if($acao == "editar" && $vetorAluno[0]["genero"] == "2") echo "selected"; ?>>Masculino</option>
                <option value="3" <?php if($acao == "editar" && $vetorAluno[0]["genero"] == "3") echo "selected"; ?>>Não-Binário</option>
                <option value="4" <?php if($acao == "editar" && $vetorAluno[0]["genero"] == "4") echo "selected"; ?>>Prefiro não dizer</option>
            </select>
            <br>
            <br>
            <select name="etapa">
                <option value="">Etapa</option>
                <option value="Ensino Fundamental" <?php if($acao == "editar" && $vetorAluno[0]["etapa"] == "Ensino Fundamental") echo "selected"; ?>>
                    Ensino Fundamental
                </option>
                <option value="Ensino Médio" <?php if($acao == "editar" && $vetorAluno[0]["etapa"] == "Ensino Médio") echo "selected"; ?>>
                    Ensino Médio
                </option>
            </select><br>
            <br>
            <button type="submit" name="acao" value="salvar">
                <?php
                    if($acao == "editar")
                        echo "Salvar alterações";
                    else
                        echo "Salvar";
                ?>
            </button></form></div>
</body>
</html>