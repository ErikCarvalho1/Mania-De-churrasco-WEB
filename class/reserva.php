<?php

include_once "db.php";

class Reserva{
    // atributos
    private $id;
    private $idClientes;
    private $dataReserva;
    private $hora;
    private $qtdPessoas;
    private $Motivo;
    private $status;
    private $dataCriacao;
    private $dataAtualizacao;

    private $pdo;
    public function __construct(){
        $this->pdo  = getConnection(); // realiza a conexão durante a criação da instância (objeto) 
    }
    // Getters e Setters  - Propriedades (C#) ou métodos de acesso das linguagens de prog.
    public function getId(){
        return $this->id; // não vamos criar setId???  proque o banco é quem atribui (autoincrements)
        
    

}
?>