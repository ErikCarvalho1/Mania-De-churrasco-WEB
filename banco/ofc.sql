-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema tdszuphpdb01
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tdszuphpdb01
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tdszuphpdb01` ;
USE `tdszuphpdb01` ;

-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(30) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `nivel` CHAR(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_uniq` (`login` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 6;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`adm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`adm` (
  `id` INT(11) NOT NULL,
  `id_usuarios` INT(11) NOT NULL,
  `nome` VARCHAR(75) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  `senha` VARCHAR(35) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_adm_usuarios` (`id_usuarios` ASC) VISIBLE,
  CONSTRAINT `fk_adm_usuarios`
    FOREIGN KEY (`id_usuarios`)
    REFERENCES `tdszuphpdb01`.`usuarios` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`clientes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuarios` INT(11) NOT NULL,
  `nome` VARCHAR(75) NOT NULL,
  `cpf` VARCHAR(18) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_id_usuarios` (`id_usuarios` ASC) VISIBLE,
  CONSTRAINT `fk_id_usuarios`
    FOREIGN KEY (`id_usuarios`)
    REFERENCES `tdszuphpdb01`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`mesas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`mesas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `numero_mesa` INT(4) NOT NULL,
  `capacidade` INT(4) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`negativas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`negativas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_reserva` INT(11) NOT NULL,
  `motivo_negativa` VARCHAR(240) NOT NULL,
  `data_registro` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`tipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`tipos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `sigla` VARCHAR(3) NOT NULL,
  `rotulo` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`produtos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo_id` INT(11) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `resumo` VARCHAR(1000) NULL DEFAULT NULL,
  `valor` DECIMAL(9,2) NULL DEFAULT NULL,
  `imagem` VARCHAR(50) NULL DEFAULT NULL,
  `destaque` BIT(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  INDEX `tipo_id_fk` (`tipo_id` ASC) VISIBLE,
  CONSTRAINT `tipo_id_fk`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `tdszuphpdb01`.`tipos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 21;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`reserva_mesa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`reserva_mesa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_mesas` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_id_mesas` (`id_mesas` ASC) VISIBLE,
  CONSTRAINT `fk_id_mesas`
    FOREIGN KEY (`id_mesas`)
    REFERENCES `tdszuphpdb01`.`mesas` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tdszuphpdb01`.`reservas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`reservas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_clientes` INT(11) NOT NULL,
  `data_reserva` DATETIME NOT NULL,
  `horario` TIME NOT NULL,
  `motivo` VARCHAR(240) NOT NULL,
  `status_rsv` BIT(1) NOT NULL,
  `qtd_pessoas` INT(11) NOT NULL,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `data_atualizacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `fk_id_clientes` (`id_clientes` ASC) VISIBLE,
  CONSTRAINT `fk_id_clientes`
    FOREIGN KEY (`id_clientes`)
    REFERENCES `tdszuphpdb01`.`clientes` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2;

USE `tdszuphpdb01` ;

-- -----------------------------------------------------
-- Placeholder table for view `tdszuphpdb01`.`vw_produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tdszuphpdb01`.`vw_produtos` (`id` INT, `tipo_id` INT, `sigla` INT, `rotulo` INT, `descricao` INT, `resumo` INT, `valor` INT, `imagem` INT, `destaque` INT);

-- -----------------------------------------------------
-- View `tdszuphpdb01`.`vw_produtos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tdszuphpdb01`.`vw_produtos`;
USE `tdszuphpdb01`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `tdszuphpdb01`.`vw_produtos` AS select `p`.`id` AS `id`,`p`.`tipo_id` AS `tipo_id`,`t`.`sigla` AS `sigla`,`t`.`rotulo` AS `rotulo`,`p`.`descricao` AS `descricao`,`p`.`resumo` AS `resumo`,`p`.`valor` AS `valor`,`p`.`imagem` AS `imagem`,`p`.`destaque` AS `destaque` from (`tdszuphpdb01`.`produtos` `p` join `tdszuphpdb01`.`tipos` `t`) where `p`.`tipo_id` = `t`.`id`;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
