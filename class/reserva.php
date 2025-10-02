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
    public function getId() {
        return $this->id;
    }
    public function getIdClientes() {
        return $this->id_clientes;
    }
    public function setIdClientes($id_clientes) {
        $this->id_clientes = $id_clientes;
    }
    public function getDataReserva() {
        return $this->data_reserva;
    }
    public function setDataReserva($data_reserva) {
        $this->data_reserva = $data_reserva;
    }
    public function getHora() {
        return $this->horario;
    }
    public function setHora($horario) {
        $this->horario = $horario;
    }
    public function getQtdPessoas() {
        return $this->qtd_pessoas;
    }
    public function setQtdPessoas($qtdPessoas) {
        $this->qtd_pessoas = $qtdPessoas;
    }
    public function getMotivo() {
        return $this->motivo;
    }
    public function setMotivo($motivo) {
        $this->motivo = $motivo;
    }
    public function getStatus() {
        return $this->status_rsv;
    }
    public function setStatus($status) {
        $this->status_rsv = $status;
    }
    public function getDataCriacao() {
        return $this->data_criacao;
    }
    public function setDataCriacao($dataCriacao) {
        $this->data_criacao = $dataCriacao;
    }
    public function getDataAtualizacao() {
        return $this->data_atualizacao;
    }
    public function setDataAtualizacao($dataAtualizacao) {
        $this->data_atualizacao = $dataAtualizacao;
    }

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

}
?>