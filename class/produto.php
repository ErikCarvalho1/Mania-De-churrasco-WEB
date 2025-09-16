<?php
include_once "db.php";
 
// POO com PHP (Classes PHP)
class Porduto{
    // atributos
 
    private $id;
    private $TipoId;
    private $descricao;
    private $resumo;
    private $valor;
    private $imagem;
    private $destaques;
    private $pdo;
    public function __construct(){
        $this->pdo = getConnection();// realiza a conexão durante a criação da instancia (objeto)
    }
    // Getter e Setters - Propriedades (C#) ou metodo de aceso das linguadgens de prog.
    public function getId(){
        return $this->id;// não vamos criar setId porque o banco é quem atribui (autoincrements)
 
    }
    public function getTipoId(){// get funçao de usuario
        return $this-> TipoId;
    }
    public function setTipoId(int $TipoId){
        $this -> TipoId = $TipoId;
 
    }
    public function getResumo(){// get funçao de usuario
        return $this-> resumo;
    }
    public function setResumo(string $resumo){
        $this -> resumo = $resumo;
 
    }
      public function getValor(){// get funçao de usuario
        return $this->  valor;
    }
    public function setValor(int $valor){
        $this -> valor = $valor;
 
    }
        public function getImagem(){// get funçao de usuario
        return $this->  imagem;
    }
    public function setImagem(string $imagem){
        $this -> imagem = $imagem;
 
    }
            public function getDestaques(){// get funçao de usuario
        return $this->  destaques;
    }
    public function setDestaques(bool $destaques){
        $this -> destaques = $destaques;
 
    }

  
  
  
 
    //inserindo um 
    public function inserirProduto(){
 
        $sql = "insert into produtos (tipo_id, descricao, resumo, valor, imagem, destaque ) values (:tipo_id ,:descricao, :resumo, :valor, :imagem,  :destaques)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":tipo_id", $this -> $TipoId);
        $cmd->bindValue(":descricao", $this->$descricao);
        $cmd->bindValue(":resumo", $this->$resumo);
        $cmd->bindValue(":valor", $this->$valor);
        $cmd->bindValue(":imagem", $this->$imagem);
        $cmd->bindValue(":destaques", $this->$destaques);
        $cmd->execute();
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
       
        return false;
    }
    // listando usuarios
    public function listar(): array {
        $cmd = $this->pdo->query("select * from vw_prdutos order by id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);// retorna uma matriz associativa de 2 dimensoes
    }
    // buscar usuario por id
    public function buscarprodutoId(int $id):bool  {
        $sql = "selct * from produtos where id = :id";
        $cmd =  $this->pdo->prepare($sql);
        $cmd -> bindValue(":id", $id);
        $cmd->execute();
        if($cmd -> rowCount() > 0){
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);// apenas de uma dimensão
            $this -> id = $dados['id'];
            $this -> TipoId = $dados[ 'tipo_id'];
            $this -> descricao = $dados ['descricao'];
            $this -> resumo = $dados  ['resumo'];
             $this -> valor = $dados  ['valor'];
              $this -> imagem = $dados  ['imagem'];
               $this -> destaque = $dados  ['destaque'];
            return true;
        }
        return false;
 
    }
    // Atualizar usuario
    public function atualizar(int $idUpdate):bool{
        $id = $idUpdate;
    if(!$this->id) return false;
  $sql = "UPDATE produtos SET tipo_id = :tipo_id, 
    descricao = :descricao,
    resumo, :resumo,
    valor = :valor,
    imagem = :imagem,
    destaque = :destaque
      WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":tipo_id", $this -> $TipoId);
        $cmd->bindValue(":descricao", $this->$descricao);
        $cmd->bindValue(":resumo", $this->$resumo);
        $cmd->bindValue(":valor", $this->$valor);
        $cmd->bindValue(":imagem", $this->$imagem);
        $cmd->bindValue(":destaques", $this->$destaques);
         $cmd->bindValue(":id", $this->$id, PDO::PARAM_INT);
        $cmd->execute();
 
    return $cmd ->execute();
    }
    // Excluir usuario
    public function excluir(int $idExcluir):bool{
        $id = $idExcluir;
        if(!$this->id) return false;

        $sql = "DELETE FROM prdutos WHERE id = :id";
        $cmd = $this-> pdo->prepare($sql);
        $cmd ->bindValue(":id", $this->id);
       $cmd->bindValue(":id", $this->$id, PDO::PARAM_INT);
        return $cmd->execute();
    }
    
    
}
   
?>