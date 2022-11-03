<?php
    require_once("../autoload.php");
    
    class Professor extends Geral{
        private $sobrenome;
        private $areaAtuacao;
        private $formacao;
        private $email;
        private $senha;
        private $fotoPerfil;
        public function __construct($id, $nome, $sobrenome, $areaAtuacao, $formacao, $email, $senha, $fotoPerfil){
            parent::__construct($id, $nome);
            $this->setSobrenome($sobrenome);
            $this->setAreaAtuacao($areaAtuacao);
            $this->setFormacao($formacao);
            $this->setEmail($email); 
            $this->setSenha($senha);
            $this->setFotoPerfil($fotoPerfil);
        }

        public function setSobrenome($sobrenome){
            if($sobrenome <> "")
                $this->sobrenome = $sobrenome;
            else
                throw new Exception("Por favor, insira o sobrenome.");
        }
        public function setAreaAtuacao($areaAtuacao){
            if($areaAtuacao <> "")
                $this->atuacao = $areaAtuacao;
            else
                throw new Exception("Por favor, insira a área de atuação.");
        }
        public function setFormacao($formacao){
            if($formacao <> "")
                $this->formacao = $formacao;
            else
                throw new Exception("Por favor, insira a formação.");
        }
        public function setEmail($email){
            if($email <> "")
                $this->email = $email;
            else
                throw new Exception("Por favor, insira o e-mail.");
        }
        public function setSenha($senha){
            if($senha <> "")
                $this->senha = $senha;
            else
                throw new Exception("Por favor, insira a senha.");
        }
        public function setFotoPerfil($fotoPerfil){
            if($fotoPerfil <> "")
                $this->fotoPerfil = $fotoPerfil;
            else
                throw new Exception("Por favor, insira uma foto de perfil.");
        }

        public function getSobrenome(){ return $this->sobrenome; }
        public function getAreaAtuacao(){ return $this->atuacao; }
        public function getFormacao(){ return $this->formacao; }
        public function getEmail(){ return $this->email; }
        public function getSenha(){ return $this->senha; }
        public function getFotoPerfil(){ return $this->fotoPerfil; }

        public function insere(){
            $sql = "INSERT INTO professor (nome, sobrenome, areaAtuacao, formacao, email, senha, fotoPerfil)
                    VALUES(:nome, :sobrenome, :areaAtuacao, :formacao, :email, :senha, :fotoPerfil)";
            $par = array(":nome"=>$this->getNome(), ":sobrenome"=>$this->getSobrenome(), ":areaAtuacao"=>$this->getAreaAtuacao(),
                        ":formacao"=>$this->getFormacao(), ":email"=>$this->getEmail(), ":senha"=>$this->getSenha(),
                        ":fotoPerfil"=>$this->getFotoPerfil());
            return Database::executaComando($sql, $par);
        }

        public static function listar($email){
            $sql = "SELECT * FROM professor
                    WHERE email = :email";
            $par = array(":email"=>$email);
            return Database::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE professor
                    SET nome = :nome, sobrenome = :sobrenome, areaAtuacao = :areaAtuacao,
                        formacao = :formacao, email = :email, senha = :senha, fotoPerfil = :fotoPerfil
                    WHERE idprofessor = :id";
            $par = array(":nome"=>$this->getNome(), ":sobrenome"=>$this->getSobrenome(), ":areaAtuacao"=>$this->getAreaAtuacao(),
                        ":formacao"=>$this->getFormacao(), ":email"=>$this->getEmail(), ":senha"=>$this->getSenha(),
                        ":fotoPerfil"=>$this->getFotoPerfil(), ":id"=>$this->getId());
            return Database::executaComando($sql, $par);
        }

        public static function excluir($id){
            $sql = "DELETE FROM professor WHERE idprofessor = :id";
            $par = array("id"=>$id);
            return Database::executaComando($sql, $par);
        }

        public static function efetuaLogin($email, $senha){
            $sql = "SELECT * FROM professor
                    WHERE email = :email
                    AND senha = :senha";
            $par = array(":email"=>$email, ":senha"=>$senha);
            $row = Database::efetuaLoginDB($sql, $par);
            if($row){
                $_SESSION["idprofessor"] = $row["idprofessor"];
                $_SESSION["nome"] = $row["nome"];
                $_SESSION["sobrenome"] = $row["sobrenome"];
                $_SESSION["areaAtuacao"] = $row["areaAtuacao"];
                $_SESSION["formacao"] = $row["formacao"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["senha"] = $row["senha"];
                $_SESSION["fotoPerfil"] = $row["fotoPerfil"];
                return true;
            } else
                return false;
        }

        public static function finalizarLogin(){
            session_destroy();
        }
    } 

?>