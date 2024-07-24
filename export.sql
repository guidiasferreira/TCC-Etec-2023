-- MySQL Script generated by MySQL Workbench
-- Wed Oct 11 21:22:14 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tcc_biblioetec
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tcc_biblioetec
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc_biblioetec` DEFAULT CHARACTER SET utf8 ;
USE `tcc_biblioetec` ;

-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(125) NOT NULL,
  `email_usuario` VARCHAR(255) NOT NULL,
  `senha_usuario` VARCHAR(125) NOT NULL,
  `recuperar_senha_usuario` VARCHAR(125) NULL,
  `rg_usuario` VARCHAR(9) NULL,
  `telefone_usuario` INT(13) NULL,
  `info_emprestimo_usuario` INT NULL,
  `data_emprestimo_usuario` DATETIME NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`editora` (
  `ideditora` INT NOT NULL AUTO_INCREMENT,
  `nome_editora` VARCHAR(125) NOT NULL,
  PRIMARY KEY (`ideditora`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`capas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`capas` (
  `idcapas` INT NOT NULL AUTO_INCREMENT,
  `local_capas` VARCHAR(125) NOT NULL,
  `nome_capas` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idcapas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`livros` (
  `idlivros` INT NOT NULL AUTO_INCREMENT,
  `nome_livros` VARCHAR(45) NOT NULL,
  `qnt_livros` INT NOT NULL,
  `editora_ideditora` INT NOT NULL,
  `capas_idcapas` INT NOT NULL,
  PRIMARY KEY (`idlivros`, `editora_ideditora`, `capas_idcapas`),
  INDEX `fk_livros_editora1_idx` (`editora_ideditora` ASC),
  INDEX `fk_livros_capas1_idx` (`capas_idcapas` ASC),
  CONSTRAINT `fk_livros_editora1`
    FOREIGN KEY (`editora_ideditora`)
    REFERENCES `tcc_biblioetec`.`editora` (`ideditora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livros_capas1`
    FOREIGN KEY (`capas_idcapas`)
    REFERENCES `tcc_biblioetec`.`capas` (`idcapas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`adm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`adm` (
  `idadm` INT NOT NULL AUTO_INCREMENT,
  `nome_adm` VARCHAR(45) NOT NULL,
  `email_adm` VARCHAR(45) NOT NULL,
  `senha_adm` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idadm`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`emprestimo` (
  `idemprestimo` INT NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` INT NOT NULL,
  `livros_idlivros` INT NOT NULL,
  `data_emprestimo` VARCHAR(45) NULL,
  `devolucao_emprestimo` VARCHAR(45) NULL,
  PRIMARY KEY (`idemprestimo`, `usuario_idusuario`, `livros_idlivros`),
  INDEX `fk_usuario_has_livros_livros1_idx` (`livros_idlivros` ASC),
  INDEX `fk_usuario_has_livros_usuario_idx` (`usuario_idusuario` ASC),
  CONSTRAINT `fk_usuario_has_livros_usuario`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `tcc_biblioetec`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_livros_livros1`
    FOREIGN KEY (`livros_idlivros`)
    REFERENCES `tcc_biblioetec`.`livros` (`idlivros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `nome_categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`autor` (
  `idautor` INT NOT NULL AUTO_INCREMENT,
  `nome_autor` VARCHAR(125) NOT NULL,
  PRIMARY KEY (`idautor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`livros_autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`livros_autor` (
  `idlivros_autor` INT NOT NULL AUTO_INCREMENT,
  `livros_id` INT NOT NULL,
  `autor_id` INT NOT NULL,
  PRIMARY KEY (`idlivros_autor`, `livros_id`, `autor_id`),
  INDEX `fk_livros_has_autor_autor1_idx` (`autor_id` ASC),
  INDEX `fk_livros_has_autor_livros1_idx` (`livros_id` ASC),
  CONSTRAINT `fk_livros_has_autor_livros1`
    FOREIGN KEY (`livros_id`)
    REFERENCES `tcc_biblioetec`.`livros` (`idlivros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livros_has_autor_autor1`
    FOREIGN KEY (`autor_id`)
    REFERENCES `tcc_biblioetec`.`autor` (`idautor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioetec`.`livros_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioetec`.`livros_categoria` (
  `idlivros_categoria` INT NOT NULL AUTO_INCREMENT,
  `livros_id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  PRIMARY KEY (`idlivros_categoria`, `livros_id`, `categoria_id`),
  INDEX `fk_livros_has_categoria_categoria1_idx` (`categoria_id` ASC),
  INDEX `fk_livros_has_categoria_livros1_idx` (`livros_id` ASC),
  CONSTRAINT `fk_livros_has_categoria_livros1`
    FOREIGN KEY (`livros_id`)
    REFERENCES `tcc_biblioetec`.`livros` (`idlivros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livros_has_categoria_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `tcc_biblioetec`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;