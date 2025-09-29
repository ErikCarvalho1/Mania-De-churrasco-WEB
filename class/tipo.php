<?php 
include_once "db.php";


class Tipo{
    private $id; 
    private $sigla; 
    private $rotulo;
    private $pdo;
    public function __construct(){
     $this->pdo = getConnection();
    }


public function getId(){
    return $this->id;
   } 

   public function getSigla(){
    return $this->sigla;
   }
   public function setSigla(string $sigla){
    $this->sigla = $sigla;

   }

   public function getRotulo(){
    return $this->rotulo;

   }
   public function setRotulo(string $rotulo){
    $this->rotulo = $rotulo;

   }

public function inserirTipo():bool{
    $sql = "INSERT INTO tipos (sigla, rotulo) VALUES (:sigla, :rotulo)";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":sigla", $this->sigla);
    $cmd->bindValue(":rotulo", $this->rotulo);
    if($cmd->execute()){
        $this->id = $this->pdo->lastInsertId();
        return true;
    }
    return false;
}

   public function atualizarTipo(int $idUpdate):bool {
            $id = $idUpdate;
            if(!$this->id) return false;
    
            $sql = "UPDATE tipos SET 
                sigla, rotulo = :sigla, :rotulo
            
                WHERE id = :id";
            $cmd = $this->pdo->prepare($sql);
             $cmd->bindValue(":sigla", $this->sigla);
            $cmd->bindValue(":rotulo", $this->rotulo);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
    
            return $cmd->execute();
        }

         public function buscarTipoPorId(int $id):array{
        $sql = "select * from tipos where id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $dados = $cmd->fetch();
    
        return $dados;
}
  public function excluirTipo(int $idExcluir):bool {
            $this->id = $idExcluir;
            if(!$this->id) return false;
    
            $sql = "delete from tipos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
            return $cmd->execute();
        }

  public function listarTipo(): array {
        $cmd = $this->pdo->query("select * from tipos order by id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);// retorna uma matriz associativa de 2 dimensoes
    }
}
?>

