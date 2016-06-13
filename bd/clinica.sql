SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `clinica` DEFAULT CHARACTER SET latin1 ;
USE `clinica` ;

-- -----------------------------------------------------
-- Table `clinica`.`consulta_particular_plano`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clinica`.`consulta_particular_plano` (
  `idconsulta` INT(11) NOT NULL AUTO_INCREMENT ,
  `paciente` VARCHAR(50) NOT NULL ,
  `medico` VARCHAR(50) NULL DEFAULT NULL ,
  `data` VARCHAR(45) NULL DEFAULT NULL ,
  `hora` VARCHAR(45) NULL DEFAULT NULL ,
  `valor` DOUBLE NULL DEFAULT NULL ,
  `plano` VARCHAR(45) NULL DEFAULT NULL ,
  `observacao` LONGTEXT NULL DEFAULT NULL ,
  `tipoObservacao` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`idconsulta`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `clinica`.`especialidade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clinica`.`especialidade` (
  `idespeci` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idespeci`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `clinica`.`medico`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clinica`.`medico` (
  `idmedic` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(25) NULL DEFAULT NULL ,
  `telefone` VARCHAR(10) NULL DEFAULT NULL ,
  `numCRM` VARCHAR(25) NULL DEFAULT NULL ,
  `endereco` VARCHAR(30) NULL DEFAULT NULL ,
  `idespecialidade` VARCHAR(45) NULL DEFAULT NULL ,
  `dias` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`idmedic`) )
ENGINE = InnoDB
AUTO_INCREMENT = 90
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `clinica`.`medico_plano`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clinica`.`medico_plano` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `idmedic` INT(11) NULL DEFAULT NULL ,
  `idplano` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idmedic` (`idmedic` ASC) ,
  INDEX `idplano` (`idplano` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 183
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `clinica`.`paciente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clinica`.`paciente` (
  `idpacie` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(25) NULL DEFAULT NULL ,
  `numCPF` VARCHAR(11) NULL DEFAULT NULL ,
  `endereco` VARCHAR(25) NULL DEFAULT NULL ,
  `telefone` VARCHAR(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`idpacie`) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `clinica`.`plano_saude`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clinica`.`plano_saude` (
  `idplano` INT(11) NOT NULL AUTO_INCREMENT ,
  `razaoSocial` VARCHAR(30) NULL DEFAULT NULL ,
  `numCNPJ` VARCHAR(15) NULL DEFAULT NULL ,
  `endereco` VARCHAR(20) NULL DEFAULT NULL ,
  `telefone` VARCHAR(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`idplano`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `clinica`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clinica`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(30) NULL DEFAULT NULL ,
  `senha` VARCHAR(20) NULL DEFAULT NULL ,
  `tipo` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 55
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
