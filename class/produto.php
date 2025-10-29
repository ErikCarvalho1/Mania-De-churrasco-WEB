<?php 
namespace App;

 include_once "db.php";

class Produto{
    // atributos
    private $id;
    private $categoriasId;
    private $descricao;
    private $resumo;
    private $valor;
    private $imagem;
    private $destaque;
    private $pdo;
    public function __construct(){
        $this->pdo  = getConnection(); // realiza a conexão durante a criação da instância (objeto) 
    }
    // Getters e Setters  - Propriedades (C#) ou métodos de acesso das linguagens de prog.
    public function getId(){
        return $this->id; // não vamos criar setId???  proque o banco é quem atribui (autoincrements)
    }
    public function getcategoriasId(){
        return $this->categoriasId;
    }
    public function setcategoriasId(int $categoriasId){
        $this->categoriasId = $categoriasId;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao(string $descricao){
        $this->descricao = $descricao;
    }
    public function getResumo(){
        return $this->resumo;
    }
    public function setResumo(string $resumo){
        $this->resumo = $resumo;
    }
    public function getValor(){
        return $this->valor;
    }
    public function setValor(float $valor){
        $this->valor = $valor;
    }
    public function getImagem(){
        return $this->imagem;
    }
    public function setImagem(string $imagem){
        $this->imagem = $imagem;
    }
    public function getDestaque(){
        return $this->destaque;
    }
    public function setDestaque(bool $destaque){
        $this->destaque = $destaque;
    }
// inserindo um produto
    public function inserir():bool{
        $sql = "INSERT INTO produtos (categoria_id, descricao, resumo, valor, imagem, destaque)
    VALUES (:categoria_id, :descricao, :resumo, :valor, :imagem, :destaque)
";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":categoria_id", $this->categoriasId); // (C#) cmd.Paramenters.AddWithValue("splogin", Login);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":resumo", $this->resumo);
        $cmd->bindValue(":valor", $this->valor);
        $cmd->bindValue(":imagem", $this->imagem);
        $cmd->bindValue(":destaque", (int)$this->destaque, PDO::PARAM_INT);
        if($cmd->execute()){
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }
    // listando produtos
    public function listar(int $destaque = 0):array{
        if ($destaque == 0){
            $cmd = $this->pdo->query("select * from vw_produtos order by id desc");
        }
        elseif ($destaque == 1) {
            $cmd = $this->pdo->query("select * from vw_produtos where destaque = 1 order by id desc");
        }
        return $cmd->fetchAll(); // pode retornar nenhum ou mais de um produto
    }
    // buscar produtos por id 
    public function buscarPorId(int $id):array{
        $sql = "select * from vw_produtos where id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $dados = $cmd->fetch(); // pode retornar nenhum ou apenas um produto
        // if($cmd->rowCount() > 0){
        //     $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        //     $this->id = $dados['id'];
        //     $this->categoriasId = $dados['categoria_id'];
        //     $this->descricao = $dados['descricao'];
        //     $this->resumo = $dados['resumo'];
        //     $this->valor = $dados['valor'];
        //     $this->imagem = $dados['imagem'];
        //     $this->destaque = $dados['destaque'];
        //     return $this;
        // }
        return $dados;
    }

        // buscar produtos por categoria_id 
        public function buscarPorcategoriasId(int $categoriasId):array{
            $sql = "select * from vw_produtos where categoria_id = :categoria_id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":categoria_id", $categoriasId);
            $cmd->execute();
            $dados = $cmd->fetchAll(); // pode retornar nenhum ou mais de um produto
            return $dados;
        }
        // buscar produtos por texto na descrição ou no resumo 
        public function buscarPorString(string $busca):array{
            $sql = "select * from vw_produtos where descricao like '%$busca%'
            or resumo like '%$busca%' 
            order by descricao asc ";
            $cmd = $this->pdo->prepare($sql);
            $cmd->execute();
            $dados = $cmd->fetchAll();// pode retornar nenhum ou mais de um produto
            return $dados;
        }
        // Atualizar produto
        public function atualizar(int $idUpdate):bool {
            $id = $idUpdate;
            if(!$this->id) return false;
    
            $sql = "UPDATE produtos SET 
                categoria_id = :categoria_id,
                descricao = :descricao, 
                resumo = :resumo,
                valor = :valor,
                imagem = :imagem,
                destaque = ".($this->destaque
                == true?1:0)."
                WHERE id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":categoria_id", $this->categoriasId); // (C#) cmd.Paramenters.AddWithValue("splogin", Login);
            $cmd->bindValue(":descricao", $this->descricao);
            $cmd->bindValue(":resumo", $this->resumo);
            $cmd->bindValue(":valor", $this->valor);
            $cmd->bindValue(":imagem", $this->imagem);
            // $cmd->bindValue(":destaque", (bool) $this->destaque);
            $cmd->bindValue(":id", $this->id);
    
            return $cmd->execute();
        }
        // Excluir produto
        public function excluir(int $idExcluir):bool {
            $this->id = $idExcluir;
            if(!$this->id) return false;
    
            $sql = "delete from produtos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id);
            return $cmd->execute();
        }

}

?>