SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `library` ;

-- -----------------------------------------------------
-- Table `library`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `library`.`user` (
  `id` INT NOT NULL ,
  `username` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NULL ,
  `displayName` VARCHAR(45) NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library`.`role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `library`.`role` (
  `id` INT NOT NULL ,
  `roleId` VARCHAR(45) NOT NULL ,
  `isDefault` TINYINT NULL ,
  `parent_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_role_role` (`parent_id` ASC) ,
  UNIQUE INDEX `roleId_UNIQUE` (`roleId` ASC) ,
  CONSTRAINT `fk_role_role`
    FOREIGN KEY (`parent_id` )
    REFERENCES `library`.`role` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library`.`user_link_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `library`.`user_link_role` (
  `user_id` INT NOT NULL ,
  `role_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `role_id`) ,
  INDEX `fk_user_link_role_role1` (`role_id` ASC) ,
  CONSTRAINT `fk_user_link_role_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `library`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_link_role_role1`
    FOREIGN KEY (`role_id` )
    REFERENCES `library`.`role` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library`.`book`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `library`.`book` (
  `id` INT NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `isbn` VARCHAR(45) NULL ,
  `author` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `isbn_UNIQUE` (`isbn` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library`.`user_link_book`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `library`.`user_link_book` (
  `user_id` INT NOT NULL ,
  `book_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `book_id`) ,
  INDEX `fk_user_link_book_book1` (`book_id` ASC) ,
  CONSTRAINT `fk_user_link_book_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `library`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_link_book_book1`
    FOREIGN KEY (`book_id` )
    REFERENCES `library`.`book` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
