<?php
    session_start();

    require_once("../autoload.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if(empty($acao))
        $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $idTurma = isset($_GET["idTurma"]) ? $_GET["idTurma"] : 0;

    $idConjunto = isset($_GET["idConjunto"]) ? $_GET["idConjunto"] : 0;

    if($acao == "salvar"){
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
        $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
        $enunciado = isset($_POST["enunciado"]) ? $_POST["enunciado"] : "";
        $tags = isset($_POST["tags"]) ? $_POST["tags"] : NULL;
        $minimoCaracteres = isset($_POST["minimoCaracteres"]) ? $_POST["minimoCaracteres"] : NULL;
        if($minimoCaracteres == NULL){
            $cont = 0;
            for($i = 0; $i < 4; $i ++){
                $alt[$i] = isset($_POST["alt".$i + 1]) ? $_POST["alt".$i + 1] : NULL;
                $exp[$i] = isset($_POST["exp".$i + 1]) ? $_POST["exp".$i + 1] : NULL;

                if($alt[$i] == NULL)
                    $cont ++;
            }

            $altCorreta = isset($_POST["altCorreta"]) ? $_POST["altCorreta"] : 0;

            if($cont > 2){
                echo "Por favor, insira, pelo menos, 2 (duas) alternativas.";
                die();
            } else if($altCorreta == 0){
                echo "Por favor, especifique a alternativa correta.";
                die();
            }
        }

        $questao = new Questao($id, $titulo, $tipo, $enunciado, $minimoCaracteres, $tags, $_SESSION["idprofessor"], $idConjunto);

        if($idTurma <> 0)
            $idConjunto .= "&idTurma=".$idTurma;

        if($id == 0){
            try{
                $questao->insere();
                if($minimoCaracteres == NULL){
                    $vetorQuestao = Questao::listar(3, $enunciado);
                    $alternativas = new Alternativas($alt[0], $exp[0], $alt[1], $exp[1], $alt[2], $exp[2], $alt[3], $exp[3], $altCorreta, $vetorQuestao[0]["idquestao"]);
                    $alternativas->insere();
                }
                header("location:../professor/conjunto.php?id=".$idConjunto);
            } catch(Exception $e){
                echo "Erro ao cadastrar a questão <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $questao->editar();
                if($minimoCaracteres == NULL){
                    $alternativas = new Alternativas($alt[0], $exp[0], $alt[1], $exp[1], $alt[2], $exp[2], $alt[3], $exp[3], $altCorreta, $id);
                    if(Alternativas::listar(0, $id))
                        $alternativas->editar();
                    else
                        $alternativas->insere();
                }
                header("location:../professor/conjunto.php?id=".$idConjunto);
            } catch(Exception $e){
                echo "Erro ao editar os dados da questão <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
    } else if($acao == "excluir"){
        try{
            if($minimoCaracteres == NULL)
                Alternativas::excluir($id);
            Questao::excluir($id);
            if($idTurma <> 0)
                $idConjunto .= "&idTurma=".$idTurma;
            header("location:../professor/conjunto.php?id=".$idConjunto);
        } catch(Exception $e){
            echo "Erro ao excluir questão".
                "<br>".
                $e->getMessage();
        }
    }
?>