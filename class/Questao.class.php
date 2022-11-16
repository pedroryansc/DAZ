<?php
    require_once("../autoload.php");

    class Questao extends Geral{
        private $tipo;
        private $enunciado;
        private $maximoCaracteres;
        private $midia;
        private $tags;
        private $idProfessor;
        private $idConjunto;
        public function __construct($id, $titulo, $tipo, $enunciado, $maximoCaracteres, $midia, $tags, $idProfessor, $idConjunto){
            parent::__construct($id, $titulo);
            $this->setTipo($tipo);
            $this->setEnunciado($enunciado);
            $this->setMaxChar($maximoCaracteres);
            $this->setMidia($midia);
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
                throw new Exception("Por favor, insira um enunciado.");
        }
        public function setMaxChar($maximoCaracteres){
            if($maximoCaracteres <> -1)
                $this->maximoCaracteres = $maximoCaracteres;
            else
                throw new Exception("Por favor, defina uma quantidade mínima de caracteres para a resposta.");
        }
        public function setMidia($midia){
            $this->midia = $midia;
        }
        public function setTags($tags){
            $this->tags = $tags;
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
        public function getMaxChar(){ return $this->maximoCaracteres; }
        public function getMidia(){ return $this->midia; }
        public function getTags(){ return $this->tags; }
        public function getIdProfessor(){ return $this->idProfessor; }
        public function getIdConjunto(){ return $this->idConjunto; }

        public function insere(){
            $sql = "INSERT INTO questao (titulo, tipo, enunciado, maximoCaracteres, 
                                        midia, tags, professor_idprofessor, conjuntoQuestoes_idconjuntoQuestoes)
                    VALUES(:titulo, :tipo, :enunciado, :maxChar, :midia, :tags, :idProfessor, :idConjunto)";
            $par = array(":titulo"=>$this->getNome(), ":tipo"=>$this->getTipo(), ":enunciado"=>$this->getEnunciado(),
                        ":maxChar"=>$this->getMaxChar(), ":midia"=>$this->getMidia(), ":tags"=>$this->getTags(),
                        ":idProfessor"=>$this->getIdProfessor(), ":idConjunto"=>$this->getIdConjunto());
            return Database::executaComando($sql, $par);
        }

        public static function listar($tipo, $info){
            $sql = "SELECT * FROM questao";
            switch($tipo){
                case(1): $sql .= " WHERE conjuntoQuestoes_idconjuntoQuestoes = :info"; break;
                case(2): $sql .= " WHERE idquestao = :info"; break;
                case(3): $sql .= " WHERE enunciado = :info"; break;
            }
            $par = array(":info"=>$info);
            return Database::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE questao
                    SET titulo = :titulo, tipo = :tipo, enunciado = :enunciado, maximoCaracteres = :maxChar, midia = :midia, tags = :tags
                    WHERE idquestao = :id";
            $par = array(":titulo"=>$this->getNome(), ":tipo"=>$this->getTipo(), ":enunciado"=>$this->getEnunciado(),
                        ":maxChar"=>$this->getMaxChar(), ":midia"=>$this->getMidia(), ":tags"=>$this->getTags(), ":id"=>$this->getId());
            return Database::executaComando($sql, $par);
        }

        public static function excluir($id){
            $sql = "DELETE FROM questao WHERE idquestao = :id";
            $par = array(":id"=>$id);
            return Database::executaComando($sql, $par);
        }
    }
?>