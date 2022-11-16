<?php
    require_once("../autoload.php");

    class Conjunto extends Geral{
        private $tags;
        private $imagem;
        private $idProfessor;
        public function __construct($id, $nome, $tags, $imagem, $idProfessor){
            parent::__construct($id, $nome);
            $this->setTags($tags);
            $this->setImagem($imagem);
            $this->setIdProfessor($idProfessor);
        }

        public function setTags($tags){
            $this->tags = $tags;
        }
        public function setImagem($imagem){
            if($imagem <> "")
                $this->imagem = $imagem;
            else
                throw new Exception("Por favor, insira uma imagem para o conjunto.");
        }
        public function setIdProfessor($idProfessor){
            if($idProfessor <> 0)
                $this->idProfessor = $idProfessor;
            else
                throw new Exception("Ocorreu um erro com a identificação do professor.");
        }

        public function getTags(){ return $this->tags; }
        public function getImagem(){ return $this->imagem; }
        public function getIdProfessor(){ return $this->idProfessor; }

        public function insere(){
            $sql = "INSERT INTO conjuntoQuestoes (nome, tags, imagem, professor_idprofessor)
                    VALUES(:nome, :tags, :imagem, :idProfessor)";
            $par = array(":nome"=>$this->getNome(), ":tags"=>$this->getTags(),
                        ":imagem"=>$this->getImagem(), ":idProfessor"=>$this->getIdProfessor());
            return Database::executaComando($sql, $par);
        }

        public static function listar($tipo, $id){
            $sql = "SELECT * FROM conjuntoQuestoes";
            switch($tipo){
                case(1): $sql .= " WHERE professor_idprofessor = :id"; break;
                case(2): $sql .= " WHERE idconjuntoQuestoes = :id"; break;
            }
            $par = array(":id"=>$id);
            return Database::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE conjuntoQuestoes
                    SET nome = :nome, tags = :tags, imagem = :imagem
                    WHERE idconjuntoQuestoes = :id";
            $par = array(":nome"=>$this->getNome(), ":tags"=>$this->getTags(), ":imagem"=>$this->getImagem(), ":id"=>$this->getId());
            return Database::executaComando($sql, $par);
        }

        public static function excluir($id){
            $sql = "DELETE FROM conjuntoQuestoes WHERE idconjuntoQuestoes = :id";
            $par = array(":id"=>$id);
            return Database::executaComando($sql, $par);
        }
    }
?>