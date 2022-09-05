<!DOCTYPE html>
<?php
    require("../utils.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    session_start();
    if (!empty($_SESSION['usuario'])) {
        echo "Logado como: ". $_SESSION['usuario'];
        $var = true;
        
        //var_dump($_SESSION['usuario']);

        $vetor = listaProfessor($_SESSION['usuario']);
    }
    else{
        $var = false;
        echo "Erro";
        // header("location:../inicial.html");
    }

    if($var){
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal (Professor) -  DAZ</title>
</head>
<body>
    <a href="principalProfessor.php">(Home)</a><br>
    <h2><?php echo $vetor[0]["nome"]." ".$vetor[0]["sobrenome"];  ?></h2>
    <p><b>Área de atuação</b></p>
    <p><?php echo $vetor[0]["areaAtuacao"]; ?></p>
    <p><b>Formação</b></p>
    <p><?php echo $vetor[0]["formacao"]; ?></p>
    <p><b>E-mail</b></p>
    <p><?php echo $vetor[0]["email"]; ?></p>
    <p>
        <b>
            <a href="cadastroProfessor.php?acao=editar&id=<?php echo $vetor[0]["idprofessor"]; ?>">Editar</a> 
            <a href="javascript:excluirRegistro('../control/ctrl_professor.php?acao=excluir&id=<?php echo $vetor[0]["idprofessor"]; ?>')">
                Excluir
            </a>
        </b>
    </p>
    <br><br>
    <p><b><a href="javascript:sairSistema('../control/ctrl_professor.php?acao=deslogar')">Sair</a></b></p>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Excluir perfil: Esta ação não pode ser desfeita. Tem certeza?"))
            location.href = url;
    }

    function sairSistema(url){
        if(confirm("Sair do Sistema: Tem certeza?"))
            location.href = url;
    }
</script>
<?php
    }
?>