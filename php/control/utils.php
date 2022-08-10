<?php
    require_once "../../conf/Conexao.php";
    $action = "";
    if(isset($_POST['action'])){$action = $_POST['action'];}else if(isset($_GET['action'])){$action = $_GET['action'];}
    $table = "";
    if(isset($_POST['table'])){$table = $_POST['table'];}else if(isset($_GET['table'])){$table = $_GET['table'];}

    include_once('../classes/Tabuleiro.class.php');
    function selection($id, $idSelect){
        $tab = new Tabuleiro("","");
        $lista = $tab->buscarTab($id);
        return option(array('idtabuleiro', 'lado'), $lista, $idSelect);
    }
    
    function selectionQuad($id, $idSelect){
        $quad = new Quadrado("","","","");
        $lista = $quad->buscarQuad($id);
        return option(array('idquadrado', 'lado'), $lista, $idSelect);
    }

    function selectionCirc($id, $idSelect){
        $cir = new Circulo("","","","");
        $lista = $cir->buscarCirc($id);
        return option(array('idcirculo', 'raio'), $lista, $idSelect);
    }

    function option($chave, $dados, $id=null){
        $str = "<option value='0'>Selecione uma opção</option>";
        $tab = new Tabuleiro("","");

        foreach($dados as $linha){
            $selected = "";
            if($id == $linha[$chave[0]]){
                $selected = "selected";
            }
            $str .= "<option ".$selected." value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
        }
        return $str;

    }

?>