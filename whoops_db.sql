-- MySQL Script generated by MySQL Workbench
-- Mon Oct 18 22:28:27 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema whoops_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema whoops_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `whoops_db` DEFAULT CHARACTER SET utf8mb4 ;
USE `whoops_db` ;

-- -----------------------------------------------------
-- Table `whoops_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `whoops_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `avatar` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whoops_db`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `whoops_db`.`questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `body` VARCHAR(255) NOT NULL,
  `created_by` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_questions_users1_idx` (`created_by` ASC)  ,
  CONSTRAINT `fk_questions_users1`
    FOREIGN KEY (`created_by`)
    REFERENCES `whoops_db`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whoops_db`.`answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `whoops_db`.`answers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `answer` VARCHAR(255) NOT NULL,
  `questions_id` INT NULL,
  `created_by` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_answers_questions1_idx` (`questions_id` ASC)  ,
  INDEX `fk_answers_users1_idx` (`created_by` ASC)  ,
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`questions_id`)
    REFERENCES `whoops_db`.`questions` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_answers_users1`
    FOREIGN KEY (`created_by`)
    REFERENCES `whoops_db`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `whoops_db`.`votes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `whoops_db`.`votes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_by` INT NULL,
  `answers_id` INT NULL,
  `num` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_votes_users1_idx` (`created_by` ASC)  ,
  INDEX `fk_votes_answers1_idx` (`answers_id` ASC)  ,
  CONSTRAINT `fk_votes_users1`
    FOREIGN KEY (`created_by`)
    REFERENCES `whoops_db`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_votes_answers1`
    FOREIGN KEY (`answers_id`)
    REFERENCES `whoops_db`.`answers` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
