<?php
    require_once("../autoload.php");

    class Questao extends Geral{
        private $tipo;
        private $enunciado;
        // private $midia;
        private $tags;
        private $idProfessor;
        private $idConjunto;
        public function __construct($id, $titulo, $tipo, $enunciado, $tags, $idProfessor, $idConjunto){
            parent::__construct($id, $titulo);
            $this->setTipo($tipo);
            $this->setEnunciado($enunciado);
            $this->setTags($tags);
            $this->setIdProfessor($idProfessor);
            $this->setIdConjunto($idConjunto);
        }

        public function setTipo($tipo){
            if($tipo <> 0)
                $this->tipo = $tipo;
            else
                throw new Exception("Ocorreu um erro com a especificação do tipo da questão.");
        }
        public function setEnunciado($enunciado){
            if($enunciado <> "")
                $this->enunciado = $enunciado;
            else
                throw new Exception("Por favor, insira o enunciado.");
        }
        public function setTags($tags){
            if($tags <> "")
                $this->tags = $tags;
            else
                throw new Exception("Por favor, insira a(s) tag(s).");
        }
        public function setIdProfessor($idProfessor){
            if($idProfessor <> 0)
                $this->idProfessor = $idProfessor;
            else
                throw new Exception("Ocorreu um erro com a identificação do professor.");
        }
        public function setIdConjunto($idConjunto){
            if($idConjunto <> 0)
                $this->idConjunto = $idConjunto;
            else
                throw new Exception("Ocorreu um erro com a identificação do conjunto.");
        }

        public function getTipo(){ return $this->tipo; }
        public function getEnunciado(){ return $this->enunciado; }
        public function getTags(){ return $this->tags; }
        public function getIdProfessor(){ return $this->idProfessor; }
        public function getIdConjunto(){ return $this->idConjunto; }

        public function insere(){
            $sql = "INSERT INTO questao (titulo, tipo, enunciado, tags, professor_idprofessor, conjuntoQuestoes_idconjuntoQuestoes)
                    VALUES(:titulo, :tipo, :enunciado, :tags, :idProfessor, :idConjunto)";
            $par = array(":titulo"=>$this->getNome(), ":tipo"=>$this->getTipo(), ":enunciado"=>$this->getEnunciado(), ":tags"=>$this->getTags(),
                        ":idProfessor"=>$this->getIdProfessor(), ":idConjunto"=>$this->getIdConjunto());
            return Database::executaComando($sql, $par);
        }

        public static function listar($tipo, $id){
            $sql = "SELECT * FROM questao";
            switch($tipo){
                case(1): $sql .= " WHERE conjuntoQuestoes_idconjuntoQuestoes = :id"; break;
                case(2): $sql .= " WHERE idquestao = :id"; break;
            }
            $par = array(":id"=>$id);
            return Database::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE questao
                    SET titulo = :titulo, tipo = :tipo, enunciado = :enunciado, tags = :tags
                    WHERE id = :id";
            $par = array(":titulo" => $this->getNome(), ":tipo" => $this->getTipo(), ":enunciado" => $this->getEnunciado(),
                        ":tags" => $this->getTags(), ":id" => $this->getId());
            return Database::executaComando($sql, $par);
        }

        public function excluir(){
            $sql = "DELETE FROM questao WHERE idquestao = :id";
            $par = array(":id"=>$this->getId());
            return Database::executaComando($sql, $par);
        }
    }
?>