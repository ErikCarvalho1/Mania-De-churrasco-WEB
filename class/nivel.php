<?php 
include_once 'db.php';

class Nivel{
    private $id;
    private $usuarioId;
    private $tag;
    private $pdo;
    public function __construct(){
        $this->pdo = getConnection();

    }
        public function getId(){
        return $this->id; // não vamos criar setId???  proque o banco é quem atribui (autoincrements)
    }
        public function getUsuarioId(){
        return $this->usuarioId;
    }
    public function setUsuarioId(int $yusuarioId){
        $this->usuarioId = $usuarioId;
    }

        public function getTag(){
        return $this->tag;
    }
    public function setTag(int $tag){
        $this->tag = $tag;
    }

    public function Inserir():bool{
    $sql = 'insert into niveis (usuario_id, tag) values(:usuario_id, :tag)';
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":usuario_id", $this->usuarioId);
    $cmd->bindValue(":tag", $this->tag);
    $cmd->execute();
     if($cmd->execute()){
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;

    }


}









?>