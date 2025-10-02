<?php


include_once "db.php";

class Reserva {
    // atributos
    private $id;
    private $id_clientes;
    private $data_reserva;
    private $horario;
    private $qtd_pessoas;
    private $motivo;
    private $status_rsv;
    private $data_criacao;
    private $data_atualizacao;

    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getIdClientes() { return $this->id_clientes; }
    public function setIdClientes($id_clientes) { $this->id_clientes = $id_clientes; }

    public function getDataReserva() { return $this->data_reserva; }
    public function setDataReserva($data_reserva) { $this->data_reserva = $data_reserva; }

    public function getHorario() { return $this->horario; }
    public function setHorario($horario) { $this->horario = $horario; }

    public function getQtdPessoas() { return $this->qtd_pessoas; }
    public function setQtdPessoas($qtd_pessoas) { $this->qtd_pessoas = $qtd_pessoas; }

    public function getMotivo() { return $this->motivo; }
    public function setMotivo($motivo) { $this->motivo = $motivo; }

    public function getStatusRsv() { return $this->status_rsv; }
    public function setStatusRsv($status_rsv) { $this->status_rsv = $status_rsv; }

    public function getDataCriacao() { return $this->data_criacao; }
    public function setDataCriacao($data_criacao) { $this->data_criacao = $data_criacao; }

    public function getDataAtualizacao() { return $this->data_atualizacao; }
    public function setDataAtualizacao($data_atualizacao) { $this->data_atualizacao = $data_atualizacao; }

    // Métodos CRUD
    public function inserir(): bool {
        $sql = "INSERT INTO reservas (id_clientes, data_reserva, horario, qtd_pessoas, motivo, status_rsv, data_criacao, data_atualizacao)
                VALUES (:id_clientes, :data_reserva, :horario, :qtd_pessoas, :motivo, :status_rsv, :data_criacao, :data_atualizacao)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id_clientes", $this->id_clientes);
        $cmd->bindValue(":data_reserva", $this->data_reserva);
        $cmd->bindValue(":horario", $this->horario);
        $cmd->bindValue(":qtd_pessoas", $this->qtd_pessoas);
        $cmd->bindValue(":motivo", $this->motivo);
        $cmd->bindValue(":status_rsv", $this->status_rsv);
        $cmd->bindValue(":data_criacao", $this->data_criacao);
        $cmd->bindValue(":data_atualizacao", $this->data_atualizacao);
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function atualizar(int $idUpdate): bool {
        $sql = "UPDATE reservas SET 
                    id_clientes = :id_clientes,
                    data_reserva = :data_reserva,
                    horario = :horario,
                    qtd_pessoas = :qtd_pessoas,
                    motivo = :motivo,
                    status_rsv = :status_rsv,
                    data_atualizacao = :data_atualizacao
                WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id_clientes", $this->id_clientes);
        $cmd->bindValue(":data_reserva", $this->data_reserva);
        $cmd->bindValue(":horario", $this->horario);
        $cmd->bindValue(":qtd_pessoas", $this->qtd_pessoas);
        $cmd->bindValue(":motivo", $this->motivo);
        $cmd->bindValue(":status_rsv", $this->status_rsv);
        $cmd->bindValue(":data_atualizacao", $this->data_atualizacao);
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