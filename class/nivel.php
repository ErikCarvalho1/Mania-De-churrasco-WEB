<?php 
include_once 'db.php';

class Nivel{
    private $id;
    private $nivel;
    private $pdo;
    public function __construct(){
        $this->pdo = getConnection();

    }
        public function getId(){
        return $this->id; // não vamos criar setId???  proque o banco é quem atribui (autoincrements)
    }
 

        public function getNivel(){
        return $this->nivel;
    }
    public function setNivel(string $nivel){
        $this->nivel = $nivel;
    }

    public function Inserir():bool{
    $sql = 'insert into niveis (nivel) values(:nivel)';
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":nivel", $this->nivel);
    $cmd->execute();
     if($cmd->execute()){
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;

    }
        public function atualizarNivel(int $idUpdate):bool {
            $id = $idUpdate;
            if(!$this->id) return false;
    
            $sql = "UPDATE nivel SET 
                nivel = :nivel,
            
                WHERE id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":nivel", $this->nivel); // (C#) cmd.Paramenters.AddWithValue("splogin", Login);
  
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
    
            return $cmd->execute();
        }
    public function buscarNivelPorId(int $id):array{
        $sql = "select * from niveis where id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $dados = $cmd->fetch();
    
        return $dados;
    }
    public function excluirNivel(int $idExcluir):bool {
            $this->id = $idExcluir;
            if(!$this->id) return false;
    
            $sql = "delete from produtos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
            return $cmd->execute();
        }
}









?>