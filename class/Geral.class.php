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

        public static function insereImagem($id, $pasta, $fotoPerfil){
            if($id == 0){
                // Recebe o último ID inserido
                $conexao = Database::iniciaConexao();
                $id = $conexao->lastInsertId();
                
                if(!file_exists("../img/".$pasta)) // Verifica se a pasta existe
                    mkdir("../img/".$pasta);
                mkdir("../img/".$pasta."/".$id); // Cria a pasta/diretório do usuário
            }
            $tmpName = $fotoPerfil["tmp_name"]; // Recebe o arquivo (com nome temporário)
            $destino = "../img/".$pasta."/".$id."/".$fotoPerfil["name"]; // Define o destino do arquivo (com nome a ser utilizado)
            move_uploaded_file($tmpName, $destino);
        }
        public static function excluiDiretorio($diretorio){
            // Exclui todos os arquivos da pasta
            $di = new RecursiveDirectoryIterator($diretorio, FilesystemIterator::SKIP_DOTS);
            $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($ri as $file){
                $file->isDir() ? rmdir($file) : unlink($file);
            }
            // Exclui a pasta
            rmdir($diretorio);
        }
    }    
?>