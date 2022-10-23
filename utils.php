<?php
    require_once("autoload.php");

    function lista($obj, $tipo, $info){
        return $obj::listar($tipo, $info);
    }
?>