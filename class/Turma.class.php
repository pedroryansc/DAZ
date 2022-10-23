<?php
    require_once("../autoload.php");

    class Turma extends Geral{
        private $instituicao;
        private $mediaGeral;
        private $idProfessor;
        public function __construct($id, $nome, $instituicao, $mediaGeral, $idProfessor){
            parent::__construct($id, $nome);
            $this->setInstituicao($instituicao);
            $this->setMediaGeral($mediaGeral);
            $this->setIdProfessor($idProfessor);
        }

        public function setInstituicao($instituicao){
            if($instituicao <> "")
                $this->instituicao = $instituicao;
            else
                throw new Exception("Por favor, insira o nome da instituição.");
        }
        public function setMediaGeral($mediaGeral){
            $this->mediaGeral = $mediaGeral;
        }
        public function setIdProfessor($idProfessor){
            if($idProfessor <> 0)
                $this->idProfessor = $idProfessor;
            else
                throw new Exception("Ocorreu um erro com a identificação do professor.");
        }

        public function getInstituicao(){ return $this->instituicao; }
        public function getMediaGeral(){ return $this->mediaGeral; }
        public function getIdProfessor(){ return $this->idProfessor; }

        public function insere(){
            $sql = "INSERT INTO turma (nome, instituicao, professor_idprofessor)
                    VALUES(:nome, :instituicao, :idProfessor)";
            $par = array(":nome"=>$this->getNome(), ":instituicao"=>$this->getInstituicao(), ":idProfessor"=>$this->getIdProfessor());
            return Database::executaComando($sql, $par);
        }

        public static function listar($tipo, $id){
            $sql = "SELECT * FROM turma";
            switch($tipo){
                case(1): $sql .= " WHERE professor_idprofessor = :id"; break;
                case(2): $sql .= " WHERE idturma = :id"; break;
            }
            $par = array(":id"=>$id);
            return Database::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE turma
                    SET nome = :nome, instituicao = :instituicao
                    WHERE idturma = :id";
            $par = array(":nome"=>$this->getNome(), ":instituicao"=>$this->getInstituicao(), ":id"=>$this->getId());
            return Database::executaComando($sql, $par);
        }

        public static function excluir($id){
            $sql = "DELETE FROM turma WHERE idturma = :id";
            $par = array(":id"=>$id);
            return Database::executaComando($sql, $par);
        }
    }
?>