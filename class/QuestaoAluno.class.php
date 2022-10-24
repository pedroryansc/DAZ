<?php
    require_once("../autoload.php");

    class QuestaoAluno{
        private $idQuestao;
        private $idAluno;
        private $resposta;
        private $tentativas;
        public function __construct($idQuestao, $idAluno, $resposta, $tentativas){
            $this->setIdQuestao($idQuestao);
            $this->setIdAluno($idAluno);
            $this->setResposta($resposta);
            $this->setTentativas($tentativas);
        }

        public function setIdQuestao($idQuestao){
            $this->idQuestao = $idQuestao;
        }
        public function setIdAluno($idAluno){
            $this->idAluno = $idAluno;
        }
        public function setResposta($resposta){
            if($resposta <> "")
                $this->resposta = $resposta;
            else
                throw new Exception("Por favor, insira sua resposta.");
        }
        public function setTentativas($tentativas){
            $this->tentativas = $tentativas;
        }

        public function getIdQuestao(){ return $this->idQuestao; }
        public function getIdAluno(){ return $this->idAluno; }
        public function getResposta(){ return $this->resposta; }
        public function getTentativas(){ return $this->tentativas; }

        public function insere(){
            $sql = "INSERT INTO questao_has_aluno (questao_idquestao, aluno_idaluno, resposta, tentativas)
                    VALUES(:idQuestao, :idAluno, :resposta, :tentativas)";
            $par = array(":idQuestao"=>$this->getIdQuestao(), ":idAluno"=>$this->getIdAluno(), ":resposta"=>$this->getResposta(), ":tentativas"=>$this->getTentativas());
            return Database::executaComando($sql, $par);
        }

        public static function listar($idQuestao, $idAluno){
            $sql = "SELECT * FROM questao_has_aluno
                    WHERE questao_idquestao = :idQuestao
                    AND aluno_idaluno = :idAluno";
            $par = array(":idQuestao"=>$idQuestao, ":idAluno"=>$idAluno);
            return Database::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE questao_has_aluno
                    SET resposta = :resposta, tentativas = :tentativas
                    WHERE questao_idquestao = :idQuestao
                    AND aluno_idaluno = :idAluno";
            $par = array(":resposta"=>$this->getResposta(), ":tentativas"=>$this->getTentativas(), ":idQuestao"=>$this->getIdQuestao(), ":idAluno"=>$this->getIdAluno());
            return Database::executaComando($sql, $par);
        }
    }
?>