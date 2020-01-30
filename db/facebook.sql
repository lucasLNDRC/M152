-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema facebook
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema facebook
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `facebook` DEFAULT CHARACTER SET utf8 ;
USE `facebook` ;

-- -----------------------------------------------------
-- Table `facebook`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facebook`.`post` (
  `idPost` INT NOT NULL AUTO_INCREMENT,
  `commentaire` LONGTEXT NOT NULL,
  `creationDate` DATE NOT NULL,
  `modificationDate` DATE NULL,
  PRIMARY KEY (`idPost`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facebook`.`Media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facebook`.`Media` (
  `idMedia` INT NOT NULL,
  `nomFichierMedia` VARCHAR(45) NOT NULL,
  `typeMedia` VARCHAR(5) NOT NULL,
  `creationDate` DATE NOT NULL,
  `modification` DATE NULL,
  `post_idPost` INT NOT NULL,
  PRIMARY KEY (`idMedia`, `post_idPost`),
  INDEX `fk_Media_post_idx` (`post_idPost` ASC),
  CONSTRAINT `fk_Media_post`
    FOREIGN KEY (`post_idPost`)
    REFERENCES `facebook`.`post` (`idPost`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
