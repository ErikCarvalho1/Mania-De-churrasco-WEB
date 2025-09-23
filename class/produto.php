<?php 
 include_once "db.php";

class Produto{
    // atributos
    private $id;
    private $tipoId;
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
    public function getTipoId(){
        return $this->tipoId;
    }
    public function setTipoId(int $tipoId){
        $this->tipoId = $tipoId;
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
        $sql = "insert into produtos (tipo_id, descricao, resumo, valor, imagem, destaque) values(:tipo_id, :descricao, :resumo, :valor, :imagem, :destaque)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":tipo_id", $this->tipoId); // (C#) cmd.Paramenters.AddWithValue("splogin", Login);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":resumo", $this->resumo);
        $cmd->bindValue(":valor", $this->valor);
        $cmd->bindValue(":imagem", $this->imagem);
        $cmd->bindValue(":destaque", $this->destaque);
        $cmd->execute();
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
        return $cmd->fetchAll(PDO::FETCH_ASSOC); // pode retornar nenhum ou mais de um produto
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
        //     $this->tipoId = $dados['tipo_id'];
        //     $this->descricao = $dados['descricao'];
        //     $this->resumo = $dados['resumo'];
        //     $this->valor = $dados['valor'];
        //     $this->imagem = $dados['imagem'];
        //     $this->destaque = $dados['destaque'];
        //     return $this;
        // }
        return $dados;
    }

        // buscar produtos por tipo_id 
        public function buscarPorTipoId(int $tipoId):array{
            $sql = "select * from vw_produtos where tipo_id = :tipo_id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":tipo_id", $tipoId);
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
                tipo_id = :tipo_id,
                descricao = :descricao, 
                resumo = :resumo,
                valor = :valor,
                imagem = :imagem,
                destaque = : destaque
                WHERE id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":tipo_id", $this->tipoId); // (C#) cmd.Paramenters.AddWithValue("splogin", Login);
            $cmd->bindValue(":descricao", $this->descricao);
            $cmd->bindValue(":resumo", $this->resumo);
            $cmd->bindValue(":valor", $this->valor);
            $cmd->bindValue(":imagem", $this->imagem);
            $cmd->bindValue(":destaque", $this->destaque);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
    
            return $cmd->execute();
        }
        // Excluir produto
        public function excluir(int $idExcluir):bool {
            $this->id = $idExcluir;
            if(!$this->id) return false;
    
            $sql = "delete from produtos where id = :id";
            $cmd = $this->pdo->prepare($sql);
            $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
            return $cmd->execute();
        }

}

?>