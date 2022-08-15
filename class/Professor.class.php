<?php
    require_once("../autoload.php");
    
    class Professor extends Geral{
        private $sobrenome;
        private $areaAtuacao;
        private $formacao;
        private $email;
        private $senha;
        public function __construct($id, $nome, $sobrenome, $areaAtuacao, $formacao, $email, $senha){
            parent::__construct($id, $nome);
            $this->setSobrenome($sobrenome);
            $this->setAreaAtuacao($areaAtuacao);
            $this->setFormacao($formacao);
            $this->setEmail($email); 
            $this->setSenha($senha);   
        }

        public function setSobrenome($sobrenome){
            if($sobrenome <> "")
                $this->sobrenome = $sobrenome;
            else
                throw new Exception("Sobrenome inválido.");
        }
        public function setAreaAtuacao($areaAtuacao){
            if($areaAtuacao <> "")
                $this->atuacao = $areaAtuacao;
            else
                throw new Exception("Área de atuação inválida.");
        }
        public function setFormacao($formacao){
            if($formacao <> "")
                $this->formacao = $formacao;
            else
                throw new Exception("Formação inválida.");
        }
        public function setEmail($email){
            if($email <> "")
                $this->email = $email;
            else
                throw new Exception("E-mail inválido.");
        }
        public function setSenha($senha){
            if($senha <> "")
                $this->senha = $senha;
            else
                throw new Exception("Senha inválida.");
        }

        public function getSobrenome(){ return $this->sobrenome; }
        public function getAreaAtuacao(){ return $this->atuacao; }
        public function getFormacao(){ return $this->formacao; }
        public function getEmail(){ return $this->email; }
        public function getSenha(){ return $this->senha; }

        public function insere(){
            $sql = "INSERT INTO professor (nome, sobrenome, areaAtuacao, formacao, email, senha)
                    VALUES(:nome, :sobrenome, :areaAtuacao, :formacao, :email, :senha)";
            $par = array(":nome"=>$this->getNome(), ":sobrenome"=>$this->getSobrenome(), ":areaAtuacao"=>$this->getAreaAtuacao(),
                        ":formacao"=>$this->getFormacao(), ":email"=>$this->getEmail(), ":senha"=>$this->getSenha());
            return parent::executaComando($sql, $par);
        }

        public static function listar($info = ""){

        }

        public function editar(){

        }

        public function excluir(){
            
        }

        public function __toString(){
            return  "Id: ".$this->getId()."<br>".
                    "Nome: ".$this->getNome()."<br>".
                    "Sobrenome: ".$this->getSobrenome()."<br>".
                    "Área de Atuação: ".$this->getAtuacao()."<br>".
                    "Email: ".$this->getEmail()."<br>".
                    "Senha: ".$this->getSenha()."<br>";
                }
        
    } 

?>