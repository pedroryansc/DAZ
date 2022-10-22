<?php
    require_once("../autoload.php");

    class ConjuntoTurma{
        private $idConjunto;
        private $idTurma;
        public function __construct($idConjunto, $idTurma){
            $this->setIdConjunto($idConjunto);
            $this->setIdTurma($idTurma);
        }

        public function setIdConjunto($idConjunto){
            $this->idConjunto = $idConjunto;
        }
        public function setIdTurma($idTurma){
            $this->idTurma = $idTurma;
        }

        public function getIdConjunto(){ return $this->idConjunto; }
        public function getIdTurma(){ return $this->idTurma; }

        public function insere(){
            $sql = "INSERT INTO conjuntoQuestoes_has_turma (conjuntoQuestoes_idconjuntoQuestoes, turma_idturma)
                    VALUES(:idConjunto, :idTurma)";
            $par = array(":idConjunto"=>$this->getIdConjunto(), ":idTurma"=>$this->getIdTurma());
            return Database::executaComando($sql, $par);
        }

        public static function listar($tipo, $id){
            $sql = "SELECT * FROM conjuntoQuestoes_has_turma";
            switch($tipo){
                case(1): $sql .= " WHERE turma_idturma = :id"; break;
                case(2): $sql .= " WHERE conjuntoQuestoes_idconjuntoQuestoes = :id"; break;
            }
            $par = array(":id"=>$id);
            return Database::buscar($sql, $par);
        }

        public static function excluir($tipo, $id){
            $sql = "DELETE FROM conjuntoQuestoes_has_turma";
            switch($tipo){
                case(1): $sql .= " WHERE conjuntoQuestoes_idconjuntoQuestoes = :id"; break;
                case(2): $sql .= " WHERE turma_idturma = :id"; break;
            }
            $par = array(":id"=>$id);
            return Database::executaComando($sql, $par);
        }
    }
?>