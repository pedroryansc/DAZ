<?php
    include_once('../conf/conf.inc.php');

    $resposta = isset($_POST['resposta'])?$_POST['resposta']:''; // captura a variável enviada pelo formulário
    $alunoid = isset($_POST['alunoid'])?$_POST['alunoid']:'';

    if ($resposta != ''){ 
        $dados = array('alunoid' => $alunoid, 'resposta' => $resposta);
        //ler dados ja existentes
        $entrou=false;
        $arquivo=array();
        if(file_exists("teste.json")){

        
            $arquivo = json_decode(file_get_contents(JSON));
            //var_dump($arquivo);
            
            foreach($arquivo as $linha){
                if($linha->alunoid==$dados['alunoid']){
                    $linha->resposta=$dados['resposta'];
                    $entrou=true;
                }
            }
            
        }
        if(!$entrou)
            array_push($arquivo, $dados);

        file_put_contents("teste.json", json_encode($arquivo));
        
        echo "true"; // retorna as informações codificadas no formato JSON
    }
    
    

?>