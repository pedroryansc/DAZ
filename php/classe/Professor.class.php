<?php
    include_once ("../classes/autoload.php");
    
    class Professor{

        private $id;
        private $nome;
        private $snome;
        private $atuacao;
        private $email;
        private $senha;

        public function __construct($id,$nome,$snome,$atuacao,$email,$senha){
          $this->setId($id); 
          $this->setNome($nome); 
          $this->setSnome($snome);
          $this->setAtuacao($atuacao);
          $this->setEmail($email); 
          $this->setSenha($senha);   
        }
        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function getNome() {
            return $this->nome;
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function getSnome() {
            return $this->snome;
        }
        public function setSnome($snome) {
            $this->snome = $snome;
        }
        public function getAtuacao() {
            return $this->atuacao;
        }
        public function setAtuacao($atuacao) {
            $this->atuacao = $atuacao;
        }
        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function getSenha() {
            return $this->senha;
        }
        public function setSenha($senha) {
            $this->senha = $senha;
        }

        public function __toString() {
            return  "Id: ".$this->getId()."<br>".
                    "Nome: ".$this->getNome()."<br>".
                    "Sobrenome: ".$this->getSnome()."".
                    "Area de Atuação: ".$this->getAtuacao()."".
                    "Email: ".$this->getEmail()."".
                    "Senha: ".$this->getSenha()."";
                }
        
    } 

?>