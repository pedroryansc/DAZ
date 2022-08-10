<?php
    spl_autoload_register(function($class){
        include 'classe/' .$class. '.class.php';
    });
?>