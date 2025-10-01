create database reserva;

create table clientes(
id int not null primary key auto_increment,
nome varchar(75) not null,
cpf  varchar(18) not null,
email varchar(120) not null ,
telefone varchar(20) not null, 
senha varchar(32) not null
 
);


CREATE TABLE reservas (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    id_clientes INT NOT NULL, 
    data_reserva DATETIME NOT NULL, 
    horario TIME NOT NULL, 
    motivo VARCHAR(240) NOT NULL, 
    status_rsv BIT NOT NULL,
    qtd_pessoas INT NOT NULL, 
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    data_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_id_clientes FOREIGN KEY (id_clientes) REFERENCES clientes(id) 
);

create table administradores(
id int not null primary key,
nome varchar(75) not null,
email varchar(120) not null,
senha varchar(35) not null
);

create table mesas(
id int not null auto_increment primary key, 
numero_mesa int(4) not null,
capacidade int (4) not null
);

create table reserva_mesa(
id int not null auto_increment  primary key, 
id_mesas int not null,
CONSTRAINT fk_id_mesas FOREIGN KEY (id_mesas) REFERENCES mesas(id) 
);

create table negativas(
id int not null auto_increment  primary key, 
id_reserva int not null,
motivo_negativa varchar(240) not null,
data_registro datetime not null
);

INSERT INTO administradores (id, nome, email, senha)
VALUES (1, 'erik', 'erik@example.com', MD5('123'));

INSERT INTO clientes (nome, cpf, email, telefone, senha)
VALUES 
('João Silva', '123.456.789-00', 'erik@example.com', '(11) 91234-5678', MD5('123'));
-- clientes(id_cliente, nome_completo, cpf, email, telefone, senha)
-- reservas(id_reserva, id_cliente, data_reserva, horario, qtd_pessoas, motivo, status, codigo_reserva, data_criacao, data_atualizacao)
-- administradores(id_admin, nome, email, senha)
-- mesas(id_mesa, numero_mesa, capacidade)
-- reserva_mesa(id_reserva, id_mesa)
-- negativas(id_negativa, id_reserva, motivo_negativa, data_registro)