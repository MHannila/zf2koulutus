SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`user` (
  `id` INT NOT NULL ,
  `username` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NULL ,
  `displayName` VARCHAR(45) NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`role` (
  `id` INT NOT NULL ,
  `roleId` VARCHAR(45) NOT NULL ,
  `isDefault` TINYINT NULL ,
  `parent_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_role_role` (`parent_id` ASC) ,
  UNIQUE INDEX `roleId_UNIQUE` (`roleId` ASC) ,
  CONSTRAINT `fk_role_role`
    FOREIGN KEY (`parent_id` )
    REFERENCES `mydb`.`role` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_link_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`user_link_role` (
  `user_id` INT NOT NULL ,
  `role_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `role_id`) ,
  INDEX `fk_user_link_role_role1` (`role_id` ASC) ,
  CONSTRAINT `fk_user_link_role_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_link_role_role1`
    FOREIGN KEY (`role_id` )
    REFERENCES `mydb`.`role` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`book`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`book` (
  `id` INT NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `isbn` VARCHAR(45) NULL ,
  `author` VARCHAR(45) NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `isbn_UNIQUE` (`isbn` ASC) ,
  INDEX `fk_book_user1` (`user_id` ASC) ,
  CONSTRAINT `fk_book_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
