<?php
    require_once("../autoload.php");

    class Alternativas{
        private $alt1;
        private $exp1;
        private $alt2;
        private $exp2;
        private $alt3;
        private $exp3;
        private $alt4;
        private $exp4;
        private $altCorreta;
        private $idQuestao;
        public function __construct($alt1, $exp1, $alt2, $exp2, $alt3, $exp3, $alt4, $exp4, $altCorreta, $idQuestao){
            $this->setAlt1($alt1);
            $this->setExp1($exp1);
            $this->setAlt2($alt2);
            $this->setExp2($exp2);
            $this->setAlt3($alt3);
            $this->setExp3($exp3);
            $this->setAlt4($alt4);
            $this->setExp4($exp4);
            $this->setAltCorreta($altCorreta);
            $this->setIdQuestao($idQuestao);
        }
        
        public function setAlt1($alt1){
            $this->alt1 = $alt1;
        }
        public function setExp1($exp1){
            $this->exp1 = $exp1;
        }
        public function setAlt2($alt2){
            $this->alt2 = $alt2;
        }
        public function setExp2($exp2){
            $this->exp2 = $exp2;
        }
        public function setAlt3($alt3){
            $this->alt3 = $alt3;
        }
        public function setExp3($exp3){
            $this->exp3 = $exp3;
        }
        public function setAlt4($alt4){
            $this->alt4 = $alt4;
        }
        public function setExp4($exp4){
            $this->exp4 = $exp4;
        }
        public function setAltCorreta($altCorreta){
            if($altCorreta <> 0)
                $this->altCorreta = $altCorreta;
            else
                throw new Exception("Por favor, especifique a alternativa correta.");
        }
        public function setIdQuestao($idQuestao){
            if($idQuestao <> 0)
                $this->idQuestao = $idQuestao;
            else
                throw new Exception("Ocorreu um erro com a identificação da questão.");
        }

        public function getAlt1(){ return $this->alt1; }
        public function getExp1(){ return $this->exp1; }
        public function getAlt2(){ return $this->alt2; }
        public function getExp2(){ return $this->exp2; }
        public function getAlt3(){ return $this->alt3; }
        public function getExp3(){ return $this->exp3; }
        public function getAlt4(){ return $this->alt4; }
        public function getExp4(){ return $this->exp4; }
        public function getAltCorreta(){ return $this->altCorreta; }
        public function getIdQuestao(){ return $this->idQuestao; }

        public function insere(){
            $sql = "INSERT INTO alternativas (alternativa1, explicacao1, alternativa2, explicacao2, alternativa3,
                                                explicacao3, alternativa4, explicacao4, alternativaCorreta, questao_idquestao)
                    VALUES(:alt1, :exp1, :alt2, :exp2, :alt3, :exp3, :alt4, :exp4, :altCorreta, :idQuestao)";
            $par = array(":alt1"=>$this->getAlt1(), ":exp1"=>$this->getExp1(), ":alt2"=>$this->getAlt2(), ":exp2"=>$this->getExp2(),
                        ":alt3"=>$this->getAlt3(), ":exp3"=>$this->getExp3(), ":alt4"=>$this->getAlt4(), ":exp4"=>$this->getExp4(),
                        ":altCorreta"=>$this->getAltCorreta(), ":idQuestao"=>$this->getIdQuestao());
            return Database::executaComando($sql, $par);
        }

        public static function listar($tipo, $id){
            $sql = "SELECT * FROM alternativas
                    WHERE questao_idquestao = :id";
            $par = array(":id"=>$id);
            return Database::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE alternativas
                    SET alternativa1 = :alt1, explicacao1 = :exp1, alternativa2 = :alt2, explicacao2 = :exp2, alternativa3 = :alt3,
                        explicacao3 = :exp3, alternativa4 = :alt4, explicacao4 = :exp4, alternativaCorreta = :altCorreta
                    WHERE questao_idquestao = :idQuestao";
            $par = array(":alt1"=>$this->getAlt1(), ":exp1"=>$this->getExp1(), ":alt2"=>$this->getAlt2(), ":exp2"=>$this->getExp2(),
                        ":alt3"=>$this->getAlt3(), ":exp3"=>$this->getExp3(), ":alt4"=>$this->getAlt4(), ":exp4"=>$this->getExp4(),
                        ":altCorreta"=>$this->getAltCorreta(), ":idQuestao"=>$this->getIdQuestao());
            return Database::executaComando($sql, $par);
        }

        public static function excluir($id){
            $sql = "DELETE FROM alternativas WHERE questao_idquestao = :id";
            $par = array(":id"=>$id);
            return Database::executaComando($sql, $par);
        }
    }
?>