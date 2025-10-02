<?php 
include_once "db.php";

class cliente{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $telefone;
    private $senha;

    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getCpf() {
        return $this->cpf;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getTelefone() {
        return $this->telefone;
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function setSenha($senha) {
        $this->senha = md5($senha); // Armazena a senha como hash MD5
    }
    // Métodos para interagir com o banco de dados
    public function salvar() {
        $sql = "INSERT INTO clientes (nome, cpf, email, telefone, senha) VALUES (:nome, :cpf, :email, :telefone, :senha)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':senha', $this->senha);
        return $stmt->execute();
    }
    public function atualizar() {
        $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, senha = :senha WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
    public function excluir($id) {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function buscarPorId($id) {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);


}
 public function login($email, $senha) {
        $sql = "SELECT * FROM clientes WHERE email = :email AND senha = :senha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', md5($senha)); // Compara a senha como hash MD5
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>
