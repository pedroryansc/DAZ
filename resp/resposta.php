<?php

    $resposta = isset($_POST['resposta'])?$_POST['resposta']:''; // captura a variável enviada pelo formulário
    $alunoid = isset($_POST['alunoid'])?$_POST['alunoid']:'';

    if ($resposta != ''){ 
        $dados = array('alunoid' => $alunoid, 'resposta' => $resposta);
        file_put_contents("teste.json", json_encode($dados));
        
        echo "true"; // retorna as informações codificadas no formato JSON
    }
    
    

?>