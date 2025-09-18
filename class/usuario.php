<?php
include_once "db.php";
 
// POO com PHP (Classes PHP)
class Usuario{
    // atributos
 
    private $id;
    private $login;
    private $senha;
    private $nivel;
    private $pdo;
    public function __construct(){
        $this->pdo = getConnection();// realiza a conexão durante a criação da instancia (objeto)
    }
    // Getter e Setters - Propriedades (C#) ou metodo de aceso das linguadgens de prog.
    public function getId(){
        return $this->id;// não vamos criar setId porque o banco é quem atribui (autoincrements)
 
    }
    public function getLogin(){// get funçao de usuario
        return $this-> login;
    }
    public function setLogin(string $login){
        $this -> login = $login;
 
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha ($senha){
        $this -> senha = $senha;
    }
    public function getNivel(string $nivel){
        return $this->nivel = $nivel;
    }
    //inserindo um ususario
    public function inserir(){
 
        $sql = "insert into usuarios (login, senha,  nivel) values (:login; md5(:senha), :nivel)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":login", $this -> login); //  (c#) cmd.Parameters.AddwithValeu("splogin", Login);
        $cmd->bindValue(":senha", $this->senha);
        $cmd->bindValue(":nivel", $this->nivel);
        $cmd->execute();
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
       
        return false;
    }
    // listando usuarios
    public function listar(): array {
        $cmd = $this->pdo->query("select * from usuario order by id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);// retorna uma matriz associativa de 2 dimensoes
    }
    // buscar usuario por id
    public function buscarprodutoId(int $id):bool  {
        $sql = "selct * from usuarios where id = :id";
        $cmd =  $this->pdo->prepare($sql);
        $cmd -> bindValue(":id", $id);
        $cmd->execute();
        if($cmd -> rowCount() > 0){
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);// apenas de uma dimensão
            $this -> id = $dados['id'];
            $this -> login = $dados[ 'login'];
            $this -> senha = $dados ['senha'];
            $this -> nivel = $dados  ['nivel'];
            return true;
        }
        return false;
 
    }
    // Atualizar usuario
    public function atualizar(int $idUpdate):bool{
        $id = $idUpdate;
    if(!$this->id) return false;
    $sql = "UPDATE usuarios SET login = :login, nivel = :nivel WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd -> bindValue(" :login", $this-> login);
    $cmd -> bindValue("nivel", $this->nivel);
    $cmd -> bindValue(":id", $this ->id, PDO:: PARAM_INT);
 
    return $cmd ->execute();
    }
    // Excluir usuario
    public function excluir():bool{
        if(!$this->id) return false;
 
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $cmd = $this-> pdo->prepare($sql);
        $cmd ->bindValue(":id", $this->id, PDO:: PARAM_INT);
 
 
        return $cmd->execute();
    }
    
    // Atualizar senha
    public function AtualizarSenh(int $idUpdate, string $novasenha):bool{
        $id = $idUpdate;
    if(!$this->id) return false;

    $sql = "UPDATE usuarios SET login = senha =md5(:senha) WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd -> bindValue("senha", $this->$novasenha);
    $cmd -> bindValue(":id", $this ->id, PDO:: PARAM_INT);
 
    return $cmd ->execute();
    }


        //efetuarlogin
        public function efetuarLogin(string $loginInformado, string $senhaInformada):array {
        $sql = "selct * from usuarios where login = :login end senha = md5(:senha)";
        $cmd =  $this->pdo->prepare($sql);
        $cmd -> bindValue(":login", $loginInformado);
         $cmd -> bindValue(":senha", $senhaInformada);
        $cmd->execute();
       
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            return $dados;
         
 
    }
}
   
?>