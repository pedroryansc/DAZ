<?php
    require_once "../../conf/Conexao.php";
    $action = "";
    if(isset($_POST['action'])){$action = $_POST['action'];}else if(isset($_GET['action'])){$action = $_GET['action'];}
    $table = "";
    if(isset($_POST['table'])){$table = $_POST['table'];}else if(isset($_GET['table'])){$table = $_GET['table'];}

    acao($action, $table);

    function acao($acao, $table){
        include_once ("../classes/autoload.php");

        if($acao == "insert"){ 
            if($table == "quadrado"){ //insert da tabela QUADRADO
                $quad = new Quadrado("", $_POST['lado'],$_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                $quad->inserir();
                header("location:../consultas/quadrado.php");
            } else if($table == "tabuleiro")  { //insert da tabela TABULEIRO
                $tab = new Tabuleiro("", $_POST['lado']);
                $tab->inserir();
                header("location:../consultas/tabuleiro.php");
            } else if($table == "usuario")  { //insert da tabela USUARIO
                $user = new Usuario("", $_POST['nome'], $_POST['login'], $_POST['senha']);
                $user->inserir();
                header("location:../consultas/usuario.php");
            }  else if($table == "triangulo")  { //insert da tabela TRIANGULO
                $tri = new Triangulo("", $_POST['base'], $_POST['lado1'], $_POST['lado2'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                $tri->inserir();
                header("location:../consultas/triangulo.php");
            } else if($table == "circulo")  { //insert da tabela CIRCULO
                $cir = new Circulo("", $_POST['raio'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                $cir->inserir();
                header("location:../consultas/circulo.php");
            }else if($table == "retangulo")  { //insert da tabela RETANGULO
                $ret = new Retangulo("", $_POST['base'], $_POST['altura'],$_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                $ret->inserir();
                header("location:../consultas/retangulo.php");
            }else if($table == "cubo")  { //insert da tabela CUBO
                $cubo = new Cubo("", $_POST['cor'], $_POST['quadrado_idquadrado'], $_POST['tabuleiro_idtabuleiro'], "");
                $cubo->inserir();
                header("location:../consultas/cubo.php");
            }else if($table == "esfera")  { //insert da tabela ESFERA
                $esfera = new Esfera("", $_POST['cor'], $_POST['circulo_idcirculo'], $_POST['tabuleiro_idtabuleiro'], "");
                $esfera->inserir();
                header("location:../consultas/esfera.php");}
        }
        
        else if($acao == "excluir"){
            if($table == "quadrado"){
                $quad = new Quadrado($_GET['idquadrado'], "", "", "");
                $quad->excluir();                
                header("location:../consultas/quadrado.php");
            } else if($table == "tabuleiro"){
                $tab = new Tabuleiro($_GET['idtabuleiro'], "");
                $tab->excluir();
                header("location:../consultas/tabuleiro.php");
            } else if($table == "usuario"){
                $user = new Usuario($_GET['idusuario'], "", "", "",);
                $user->excluir();
                header("location:../consultas/usuario.php");
            } else if($table == "triangulo"){
                $tri = new Triangulo($_GET['idtriangulo'], "", "","", "","");
                $tri->excluir();
                header("location:../consultas/triangulo.php");
            } else if($table == "circulo"){
                $cir = new Circulo($_GET['idcirculo'], "","","");
                $cir->excluir();
                header("location:../consultas/circulo.php");
            } else if($table == "retangulo"){
                $ret = new Retangulo($_GET['idretangulo'], "","","", "");
                $ret->excluir();
                header("location:../consultas/retangulo.php");
            } else if($table == "cubo"){
                $cubo = new Cubo($_GET['idcubo'], "","","","");
                $cubo->excluir();
                header("location:../consultas/cubo.php");
            }else if($table == "esfera"){
                $esfera = new Esfera($_GET['idesfera'], "","","","");
                $esfera->excluir();
                header("location:../consultas/esfera.php");
            }
        }

            if($acao == "editar"){
                if($table == "quadrado"){
                    $quad = new Quadrado($_POST['idquadrado'], $_POST['lado'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                    $quad->editar();
                header("location:../consultas/quadrado.php");  
            } else if ($table == "tabuleiro"){
                    $tab = new Tabuleiro($_POST['idtabuleiro'], $_POST['lado']);
                $tab ->editar();
                header("location:../consultas/tabuleiro.php");
            }else if ($table == "usuario"){
                $user = new Usuario ($_POST['idusuario'], $_POST['nome'], $_POST['login'], $_POST['senha']);
                $user->editar();
                header("location:../consultas/usuario.php");
            }else if ($table == "triangulo"){
                $tri = new Triangulo($_POST['idtriangulo'], $_POST['base'], $_POST['lado1'], $_POST['lado2'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                $tri->editar();
                header("location:../consultas/triangulo.php");
            }else if ($table == "circulo"){
                $cir = new Circulo($_POST['idcirculo'], $_POST['raio'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                $cir->editar();
                header("location:../consultas/circulo.php");
            }else if ($table == "retangulo"){
                $ret = new Retangulo($_POST['idretangulo'], $_POST['base'],$_POST['altura'], $_POST['cor'], $_POST['tabuleiro_idtabuleiro']);
                $ret->editar();
                header("location:../consultas/retangulo.php");
            }else if ($table == "cubo"){
                $cubo = new Cubo($_POST['idcubo'], $_POST['cor'],$_POST['quadrado_idquadrado'], $_POST['tabuleiro_idtabuleiro'], "");
                $cubo->editar();
                header("location:../consultas/cubo.php");
            }else if ($table == "esfera"){
                $esfera = new Esfera($_POST['idesfera'], $_POST['cor'],$_POST['circulo_idcirculo'], $_POST['tabuleiro_idtabuleiro'], "");
                $esfera->editar();
                header("location:../consultas/esfera.php");
            }
        }
}
?>