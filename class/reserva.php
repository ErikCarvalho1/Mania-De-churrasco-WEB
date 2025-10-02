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
    private $status;
    private $dataCriacao;
    private $dataAtualizacao;

    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getIdClientes() { return $this->idClientes; }
    public function setIdClientes($idClientes) { $this->idClientes = $idClientes; }

    public function getDataReserva() { return $this->dataReserva; }
    public function setDataReserva($dataReserva) { $this->dataReserva = $dataReserva; }

    public function getHora() { return $this->hora; }
    public function setHora($hora) { $this->hora = $hora; }

    public function getQtdPessoas() { return $this->qtdPessoas; }
    public function setQtdPessoas($qtdPessoas) { $this->qtdPessoas = $qtdPessoas; }

    public function getMotivo() { return $this->motivo; }
    public function setMotivo($motivo) { $this->motivo = $motivo; }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = $status; }

    public function getDataCriacao() { return $this->dataCriacao; }
    public function setDataCriacao($dataCriacao) { $this->dataCriacao = $dataCriacao; }

    public function getDataAtualizacao() { return $this->dataAtualizacao; }
    public function setDataAtualizacao($dataAtualizacao) { $this->dataAtualizacao = $dataAtualizacao; }

    // Inserir reserva
    public function inserir(): bool {
        $sql = "INSERT INTO reservas (id_clientes, data_reserva, hora, qtd_pessoas, motivo, status, data_criacao, data_atualizacao)
                VALUES (:id_clientes, :data_reserva, :hora, :qtd_pessoas, :motivo, :status, :data_criacao, :data_atualizacao)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id_clientes", $this->idClientes);
        $cmd->bindValue(":data_reserva", $this->dataReserva);
        $cmd->bindValue(":hora", $this->hora);
        $cmd->bindValue(":qtd_pessoas", $this->qtdPessoas);
        $cmd->bindValue(":motivo", $this->motivo);
        $cmd->bindValue(":status", $this->status);
        $cmd->bindValue(":data_criacao", $this->dataCriacao);
        $cmd->bindValue(":data_atualizacao", $this->dataAtualizacao);
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    // Listar reservas
    public function listar(): array {
        $cmd = $this->pdo->query("SELECT * FROM reservas ORDER BY id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar reserva por ID
    public function buscarPorId(int $id): array {
        $sql = "SELECT * FROM reservas WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar reserva
    public function atualizar(int $idUpdate): bool {
        $sql = "UPDATE reservas SET id_clientes = :id_clientes, data_reserva = :data_reserva, hora = :hora, qtd_pessoas = :qtd_pessoas, motivo = :motivo, status = :status, data_atualizacao = :data_atualizacao WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id_clientes", $this->idClientes);
        $cmd->bindValue(":data_reserva", $this->dataReserva);
        $cmd->bindValue(":hora", $this->hora);
        $cmd->bindValue(":qtd_pessoas", $this->qtdPessoas);
        $cmd->bindValue(":motivo", $this->motivo);
        $cmd->bindValue(":status", $this->status);
        $cmd->bindValue(":data_atualizacao", $this->dataAtualizacao);
        $cmd->bindValue(":id", $idUpdate);
        return $cmd->execute();
    }

    // Excluir reserva
    public function excluir(int $idExcluir): bool {
        $sql = "DELETE FROM reservas WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $idExcluir);
        return $cmd->execute();
    }
}

?>