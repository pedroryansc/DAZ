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
        $minimoCaracteres = NULL;
        if($tipo == 1){
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
        } else
            $minimoCaracteres = isset($_POST["minimoCaracteres"]) ? $_POST["minimoCaracteres"] : -1;

        $questao = new Questao($id, $titulo, $tipo, $enunciado, $minimoCaracteres, $tags, $_SESSION["idprofessor"], $idConjunto);

        if($idTurma <> 0)
            $idConjunto .= "&idTurma=".$idTurma;

        if($id == 0){
            try{
                $questao->insere();
                if($tipo == 1){
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
                if($tipo == 1){
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
            QuestaoAluno::excluir(1, $id);
            $vetorQuestao = Questao::listar(2, $id);
            if($vetorQuestao[0]["tipo"] == 1)
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
    } else if($acao == "responder"){
        $proxima = isset($_GET["proxima"]) ? $_GET["proxima"] : 0;
        $resposta = isset($_POST["resposta"]) ? $_POST["resposta"] : "";

        $vetorAluno = Aluno::listar(2, $_SESSION["idaluno"]);
        $numQuestResp = $vetorAluno[0]["numQuestResp"];
        $numAcertos = $vetorAluno[0]["numAcertos"];
        $vetorQuestao = Questao::listar(2, $id);
        $vetorAlternativas = Alternativas::listar(0, $id);

        if($vetorQuestao[0]["tipo"] == 1){
            if($resposta == $vetorAlternativas[0]["alternativaCorreta"])
                $resultado = "O";
            else
                $resultado = "X";
        } else{
            $resultado = NULL;
            if(strlen($resposta) < $vetorQuestao[0]["minimoCaracteres"]){
                echo "Por favor, insira uma resposta com o mínimo de caracteres pedido.";
                die();
            }
        }

        $vetorQuestaoAluno = QuestaoAluno::listar($id, $_SESSION["idaluno"]);

        if($vetorQuestaoAluno){
            try{
                $questaoAluno = new QuestaoAluno($id, $_SESSION["idaluno"], $resposta, $resultado, $vetorQuestaoAluno[0]["tentativas"] + 1);
                $questaoAluno->editar();
            } catch(Exception $e){
                echo "Erro ao editar a resposta <br>".
                    "<br>".
                    $e->getMessage();
                die();
            }
        } else{
            try{
                $questaoAluno = new QuestaoAluno($id, $_SESSION["idaluno"], $resposta, $resultado, 1);
                $questaoAluno->insere();
                if($vetorQuestao[0]["tipo"] == 1)
                    $numQuestResp = $vetorAluno[0]["numQuestResp"] + 1;
            } catch(Exception $e){
                echo "Erro ao cadastrar resposta <br>".
                    "<br>".
                    $e->getMessage();
                die();
            }
        }

        if($vetorQuestao[0]["tipo"] == 1){
            if($resultado == "O")
                $numAcertos = $vetorAluno[0]["numAcertos"] + 1;

            Aluno::atualizaMedia($_SESSION["idaluno"], $numAcertos, $numQuestResp);
            
            $vetorAlunos = Aluno::listar(1, $_SESSION["turma_idturma"]);
            $somaMedias = 0;
            foreach($vetorAlunos as $aluno){
                $somaMedias = $somaMedias + $aluno["media"];
            }

            Turma::atualizaMediaGeral($_SESSION["turma_idturma"], $somaMedias, count($vetorAlunos));
        }

        $vetorQuestoes = Questao::listar(1, $vetorQuestao[0]["conjuntoQuestoes_idconjuntoQuestoes"]);
        for($i = 0; $i < count($vetorQuestoes); $i ++){
            if($vetorQuestoes[$i]["idquestao"] == $vetorQuestao[0]["idquestao"]){
                if(!empty($vetorQuestoes[$i + 1])){
                    $ultimaQuestao = $vetorQuestoes[$i + 1]["idquestao"];
                    break;
                } else
                    $ultimaQuestao = NULL;
            }
        }
        Aluno::atualizaUltQuestao($_SESSION["idaluno"], $ultimaQuestao);

        if($proxima <> 0)
            header("location:../aluno/questao.php?id=".$proxima);
        else
            header("location:../aluno/fimConjunto.php?id=".$idConjunto);
    } else if($acao == "prosseguir"){
        $vetorConjuntosTurma = ConjuntoTurma::listar(1, $_SESSION["turma_idturma"]);
        for($i = 0; $i < count($vetorConjuntosTurma); $i ++){
            if($vetorConjuntosTurma[$i]["conjuntoQuestoes_idconjuntoQuestoes"] == $idConjunto){
                if(!empty($vetorConjuntosTurma[$i + 1])){
                    $vetorQuestoes = Questao::listar(1, $vetorConjuntosTurma[$i + 1]["conjuntoQuestoes_idconjuntoQuestoes"]);
                    $ultimaQuestao = $vetorQuestoes[0]["idquestao"];
                } else
                    $ultimaQuestao = NULL;
            }
        }
        Aluno::atualizaUltQuestao($_SESSION["idaluno"], $ultimaQuestao);

        header("location:../aluno/fimConjunto.php?id=".$idConjunto."&idQuestao=".$ultimaQuestao);
    }
?>