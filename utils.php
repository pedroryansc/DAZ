<?php
    require_once("autoload.php");

    function lista($obj, $tipo, $id){
        return $obj::listar($tipo, $id);
    }
?>