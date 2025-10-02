<?php


include_once "db.php";

class Reserva {
    // atributos
    private $id;
    private $idClientes;
    private $dataReserva;
    private $hora;
    private $qtdPessoas;
    private $motivo;
    private $statusRsv;
    private $dataCriacao;
    private $dataAtualizacao;

    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    public function getIdClientes() {
        return $this->idClientes;
    }
    public function setIdClientes($idClientes) {
        $this->idClientes = $idClientes;
    }
    public function getDataReserva() {
        return $this->dataReserva;
    }
    public function setDataReserva($dataReserva) {
        $this->dataReserva = $dataReserva;
    }
    public function getHora() {
        return $this->hora;
    }
    public function setHora($hora) {
        $this->hora = $hora;
    }
    public function getQtdPessoas() {
        return $this->qtdPessoas;
    }
    public function setQtdPessoas($qtdPessoas) {
        $this->qtdPessoas = $qtdPessoas;
    }
    public function getMotivo() {
        return $this->motivo;
    }
    public function setMotivo($motivo) {
        $this->motivo = $motivo;
    }
    public function getStatus() {
        return $this->status;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function getDataCriacao() {
        return $this->dataCriacao;
    }
    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }
    public function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }
    public function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

    // Métodos CRUD
    public function inserir(): bool {
        $sql = "INSERT INTO reservas (idClientes, dataReserva, hora, qtdPessoas, motivo, statusRsv, dataCriacao, dataAtualizacao)
                VALUES (:id_clientes, :dataReserva, :horario, :qtd_pessoas, :motivo, :status_rsv, :data_criacao, :data_atualizacao)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":idClientes", $this->idClientes);
        $cmd->bindValue(":dataReserva", $this->dataReserva);
        $cmd->bindValue(":hora", $this->hora);
        $cmd->bindValue(":qtdPessoas", $this->qtdPessoas);
        $cmd->bindValue(":motivo", $this->motivo);
        $cmd->bindValue(":status", $this->status);
        $cmd->bindValue(":dataCriacao", $this->dataCriacao);
        $cmd->bindValue(":dataAtualizacao", $this->dataAtualizacao);
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function atualizar(int $idUpdate): bool {
        $sql = "UPDATE reservas SET 
                    idClientes = :idClientes,
                    dataReserva = :dataReserva,
                    hora = :hora,
                    qtdPessoas = :qtdPessoas,
                    motivo = :motivo,
                    status = :status,
                    dataAtualizacao = :dataAtualizacao
                WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":idClientes", $this->idClientes);
        $cmd->bindValue(":dataReserva", $this->dataReserva);
        $cmd->bindValue(":hora", $this->hora);
        $cmd->bindValue(":qtdPessoas", $this->qtdPessoas);
        $cmd->bindValue(":motivo", $this->motivo);
        $cmd->bindValue(":status", $this->status);
        $cmd->bindValue(":dataAtualizacao", $this->dataAtualizacao);
        $cmd->bindValue(":id", $idUpdate, PDO::PARAM_INT);
        return $cmd->execute();
    }

    public function buscarPorId(int $id): array {
        $sql = "SELECT * FROM reservas WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id, PDO::PARAM_INT);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    public function excluir(int $idExcluir): bool {
        $sql = "DELETE FROM reservas WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $idExcluir, PDO::PARAM_INT);
        return $cmd->execute();
    }

    public function listar(): array {
        $cmd = $this->pdo->query("SELECT * FROM reservas ORDER BY id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>