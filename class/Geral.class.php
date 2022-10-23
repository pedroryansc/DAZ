<?php
    require_once("../autoload.php");
    
    abstract class Geral{
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
                throw new Exception("Por favor, insira o nome.");
        }

        public function getId(){ return $this->id; }
        public function getNome(){ return $this->nome; }

        public abstract function insere();
        public abstract function editar();
        public abstract static function excluir($id);
    }    
?>