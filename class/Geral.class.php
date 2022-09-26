<?php
    require_once("../autoload.php");
    
    abstract class Geral extends Database{
        private $id;
        private $nome;
        public function __construct($id, $nome){
            $this->setId($id);
            $this->setNome($nome);
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setNome($nome){
            if($nome <> "")
                $this->nome = $nome;
            else
                throw new Exception("Nome inválido.");
        }

        public function getId(){ return $this->id; }
        public function getNome(){ return $this->nome; }

        public abstract function insere();
        public abstract static function listar($info);
        public abstract function editar();
        public abstract function excluir(); 
    }    
?>