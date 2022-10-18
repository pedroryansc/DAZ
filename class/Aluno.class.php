<?php
    require_once("../autoload.php");

    class Aluno extends Geral{
        private $sobrenome;
        private $genero;
        private $etapa;
        private $numQuestResp;
        private $numAcertos;
        private $media;
        // private $fotoPerfil;
        private $idProfessor;
        private $idTurma;
        public function __construct($id, $nome, $sobrenome, $genero, $etapa, $numQuestResp, $numAcertos, $media, $idProfessor, $idTurma){
            parent::__construct($id, $nome);
            $this->setSobrenome($sobrenome);
            $this->setGenero($genero);
            $this->setEtapa($etapa);
            $this->setNumQuestResp($numQuestResp);
            $this->setNumAcertos($numAcertos);
            $this->setMedia($media);
            $this->setIdProfessor($idProfessor);
            $this->setIdTurma($idTurma);
        }

        public function setSobrenome($sobrenome){
            if($sobrenome <> "")
                $this->sobrenome = $sobrenome;
            else
                throw new Exception("Por favor, insira o sobrenome.");
        }
        public function setGenero($genero){
            if($genero <> "")
                $this->genero = $genero;
            else
                throw new Exception("Por favor, especifique o gênero.");
        }
        public function setEtapa($etapa){
            if($etapa <> "")
                $this->etapa = $etapa;
            else
                throw new Exception("Por favor, especifique a etapa do aluno.");
        }
        public function setNumQuestResp($numQuestResp){
            $this->numQuestResp = $numQuestResp;
        }
        public function setNumAcertos($numAcertos){
            $this->numAcertos = $numAcertos;
        }
        public function setMedia($media){
            $this->media = $media;
        }
        public function setIdProfessor($idProfessor){
            if($idProfessor <> 0)
                $this->idProfessor = $idProfessor;
            else
                throw new Exception("Ocorreu um erro com a identificação do professor.");
        }
        public function setIdTurma($idTurma){
            if($idTurma <> 0)
                $this->idTurma = $idTurma;
            else
                throw new Exception("Ocorreu um erro com a identificação da turma.");
        }

        public function getSobrenome(){ return $this->sobrenome; }
        public function getGenero(){ return $this->genero; }
        public function getEtapa(){ return $this->etapa; }
        public function getNumQuestResp(){ return $this->numQuestResp; }
        public function getNumAcertos(){ return $this->numAcertos; }
        public function getMedia(){ return $this->media; }
        public function getIdProfessor(){ return $this->idProfessor; }
        public function getIdTurma(){ return $this->idTurma; }

        public function insere(){
            $sql = "INSERT INTO aluno (nome, sobrenome, genero, etapa, numQuestResp, numAcertos, professor_idprofessor, turma_idturma)
                    VALUES(:nome, :sobrenome, :genero, :etapa, :numQuestResp, :numAcertos, :idProfessor, :idTurma)";
            $par = array(":nome"=>$this->getNome(), ":sobrenome"=>$this->getSobrenome(), ":genero"=>$this->getGenero(),
                        ":etapa"=>$this->getEtapa(), ":numQuestResp"=>$this->getNumQuestResp(), ":numAcertos"=>$this->getNumAcertos(),
                        ":idProfessor"=>$this->getIdProfessor(), ":idTurma"=>$this->getIdTurma());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo, $id){
            $sql = "SELECT * FROM aluno";
            switch($tipo){
                case(1): $sql .= " WHERE turma_idturma = :id"; break;
                case(2): $sql .= " WHERE idaluno = :id"; break;
            }
            $par = array(":id"=>$id);
            return parent::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE aluno
                    SET nome = :nome, sobrenome = :sobrenome, genero = :genero, etapa = :etapa
                    WHERE idaluno = :id";
            $par = array(":nome"=>$this->getNome(), ":sobrenome"=>$this->getSobrenome(),
                        ":genero"=>$this->getGenero(), ":etapa"=>$this->getEtapa(), ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function excluir(){
            $sql = "DELETE FROM aluno WHERE idaluno = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public static function efetuaLogin($id){
            $sql = "SELECT * FROM aluno
                    WHERE idaluno = :id";
            $par = array(":id"=>$id);
            $row = parent::efetuaLoginDB($sql, $par);
            if($row){
                $_SESSION["idaluno"] = $row["idaluno"];
                $_SESSION["nome"] = $row["nome"];
                $_SESSION["sobrenome"] = $row["sobrenome"];
                $_SESSION["genero"] = $row["genero"];
                $_SESSION["etapa"] = $row["etapa"];
                $_SESSION["numQuestResp"] = $row["numQuestResp"];
                $_SESSION["numAcertos"] = $row["numAcertos"];
                $_SESSION["media"] = $row["media"];
                $_SESSION["fotoPerfil"] = $row["fotoPerfil"];
                $_SESSION["professor_idprofessor"] = $row["professor_idprofessor"];
                $_SESSION["turma_idturma"] = $row["turma_idturma"];
                return true;
            } else
                return false;
        }

        public static function finalizarLogin(){
            session_destroy();
        }
    }
?>