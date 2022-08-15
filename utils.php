<?php
    require_once("autoload.php");

    function listaTabuleiro($tipo, $info){
        $tab = new Tabuleiro(1, 1);
        $lista = $tab->listar($tipo, $info);
        return $lista;
    }

    function listaQuadrado($tipo, $info){
        $quad = new Quadrado(1, 1, 1, 1);
        $lista = $quad->listar($tipo, $info);
        return $lista;
    }

    function listaTriangulo($tipo, $info){
        $tri = new Triangulo(1, 1, 1, 1, 1, 1);
        $lista = $tri->listar($tipo, $info);
        return $lista;
    }

    function listaRetangulo($tipo, $info){
        $ret = new Retangulo(1, 1, 1, 1, 1);
        $lista = $ret->listar($tipo, $info);
        return $lista;
    }

    function listaCirculo($tipo, $info){
        $cir = new Circulo(1, 1, 1, 1);
        $lista = $cir->listar($tipo, $info);
        return $lista;
    }

    function listaCubo($tipo, $info){
        $cubo = new Cubo(1, 1, 1, 1, 1);
        $lista = $cubo->listar($tipo, $info);
        return $lista;
    }

    function listaUsuario($tipo, $info){
        $user = new Usuario(1, 1, 1, 1);
        $lista = $user->listar($tipo, $info);
        return $lista;
    }
?>