SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `uid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(64) NOT NULL ,
  `password` VARCHAR(64) NOT NULL ,
  `type` TINYINT NOT NULL ,
  `lastname` VARCHAR(64) NOT NULL ,
  `firstname` VARCHAR(64) NOT NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`games`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`games` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`games` (
  `gid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) NOT NULL ,
  `organizer` INT NOT NULL ,
  `start_time` TIMESTAMP NULL ,
  `duration` INT NULL ,
  `creation` DATE NULL ,
  `sport` INT NULL ,
  `desc` VARCHAR(1024) NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`gid`) ,
  UNIQUE INDEX `gid_UNIQUE` (`gid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`matches`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`matches` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`matches` (
  `mid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `uid` INT NOT NULL ,
  `gid` INT NOT NULL ,
  `selected` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`mid`) ,
  UNIQUE INDEX `mid_UNIQUE` (`mid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`friendship`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`friendship` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`friendship` (
  `uid1` INT NOT NULL ,
  `uid2` INT NOT NULL ,
  PRIMARY KEY (`uid1`, `uid2`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ratings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ratings` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`ratings` (
  `rid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `rater` INT NULL ,
  `ratee` TINYINT NULL ,
  `value` INT NULL ,
  `comment` VARCHAR(1024) NULL ,
  `type` INT NULL ,
  `time` DATE NULL ,
  PRIMARY KEY (`rid`) ,
  UNIQUE INDEX `rid_UNIQUE` (`rid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`sports`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`sports` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`sports` (
  `sid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) NULL ,
  `description` VARCHAR(1024) NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`sid`) ,
  UNIQUE INDEX `sid_UNIQUE` (`sid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`messages` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`messages` (
  `mid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `receiver` INT NULL ,
  `sender` INT NULL ,
  `subject` VARCHAR(45) NULL ,
  `body` VARCHAR(1024) NULL ,
  `time` DATE NULL ,
  PRIMARY KEY (`mid`) ,
  UNIQUE INDEX `mid_UNIQUE` (`mid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`announcements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`announcements` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`announcements` (
  `aid` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `uid` INT NULL ,
  `title` VARCHAR(64) NULL ,
  `body` VARCHAR(1024) NULL ,
  `time` DATE NULL ,
  PRIMARY KEY (`aid`) ,
  UNIQUE INDEX `aid_UNIQUE` (`aid` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_sports`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`user_sports` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`user_sports` (
  `uid` INT NOT NULL ,
  `sid` INT NOT NULL )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
