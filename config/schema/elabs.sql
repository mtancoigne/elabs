-- MySQL Script generated by MySQL Workbench
-- lun. 09 nov. 2015 20:36:09 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema elabs
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema elabs
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `elabs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `elabs` ;

-- -----------------------------------------------------
-- Table `elabs`.`acos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`acos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `parent_id` INT(11) NULL DEFAULT NULL COMMENT '',
  `model` VARCHAR(255) NULL DEFAULT '' COMMENT '',
  `foreign_key` INT(11) NULL DEFAULT NULL COMMENT '',
  `alias` VARCHAR(255) NULL DEFAULT '' COMMENT '',
  `lft` INT(11) NULL DEFAULT NULL COMMENT '',
  `rght` INT(11) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `lft` (`lft` ASC, `rght` ASC)  COMMENT '',
  INDEX `alias` (`alias` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`aros_acos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`aros_acos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `aro_id` INT(11) NOT NULL COMMENT '',
  `aco_id` INT(11) NOT NULL COMMENT '',
  `_create` VARCHAR(2) NOT NULL DEFAULT 0 COMMENT '',
  `_read` VARCHAR(2) NOT NULL DEFAULT 0 COMMENT '',
  `_update` VARCHAR(2) NOT NULL DEFAULT 0 COMMENT '',
  `_delete` VARCHAR(2) NOT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `aro_id` (`aro_id` ASC, `aco_id` ASC)  COMMENT '',
  INDEX `aco_id` (`aco_id` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`aros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`aros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `parent_id` INT(11) NULL DEFAULT NULL COMMENT '',
  `model` VARCHAR(255) NULL DEFAULT '' COMMENT '',
  `foreign_key` INT(11) NULL DEFAULT NULL COMMENT '',
  `alias` VARCHAR(255) NULL DEFAULT '' COMMENT '',
  `lft` INT(11) NULL DEFAULT NULL COMMENT '',
  `rght` INT(11) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `lft` (`lft` ASC, `rght` ASC)  COMMENT '',
  INDEX `alias` (`alias` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`users` (
  `id` CHAR(36) NULL COMMENT '',
  `email` VARCHAR(255) NOT NULL COMMENT '',
  `username` VARCHAR(32) NOT NULL COMMENT '',
  `realname` VARCHAR(100) NULL COMMENT '',
  `password` VARCHAR(255) NOT NULL COMMENT '',
  `website` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `bio` TEXT NULL DEFAULT NULL COMMENT '',
  `created` DATETIME NOT NULL COMMENT '',
  `modified` DATETIME NOT NULL COMMENT '',
  `role` VARCHAR(20) NOT NULL COMMENT '',
  `see_nsfw` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `status` SMALLINT(1) NOT NULL DEFAULT '0' COMMENT '',
  `post_count` INT NOT NULL DEFAULT 0 COMMENT '',
  `project_count` INT NOT NULL DEFAULT 0 COMMENT '',
  `file_count` INT NOT NULL DEFAULT 0 COMMENT '',
  `project_user_count` INT NOT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`acts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`acts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `model` VARCHAR(30) NOT NULL COMMENT '',
  `fkid` CHAR(36) NOT NULL COMMENT '',
  `type` VARCHAR(30) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `elabs`.`licenses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`licenses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(50) NOT NULL COMMENT '',
  `link` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `icon` VARCHAR(20) NULL DEFAULT NULL COMMENT '',
  `post_count` INT NOT NULL DEFAULT 0 COMMENT '',
  `project_count` INT NOT NULL DEFAULT 0 COMMENT '',
  `file_count` INT NOT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`posts` (
  `id` CHAR(36) NOT NULL COMMENT '',
  `title` VARCHAR(45) NOT NULL COMMENT '',
  `excerpt` VARCHAR(255) NOT NULL COMMENT '',
  `text` TEXT NULL DEFAULT NULL COMMENT '',
  `sfw` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '',
  `created` DATETIME NOT NULL COMMENT '',
  `modified` DATETIME NOT NULL COMMENT '',
  `status` INT(1) NOT NULL DEFAULT '0' COMMENT '',
  `publication_date` DATETIME NULL COMMENT '',
  `user_id` CHAR(36) NOT NULL COMMENT '',
  `license_id` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_posts_users1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_posts_licenses1_idx` (`license_id` ASC)  COMMENT '',
  CONSTRAINT `fk_posts_licenses`
    FOREIGN KEY (`license_id`)
    REFERENCES `elabs`.`licenses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `elabs`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`projects` (
  `id` CHAR(36) NOT NULL COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `short_description` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
  `description` TEXT NULL DEFAULT NULL COMMENT '',
  `sfw` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `mainurl` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
  `created` DATETIME NOT NULL COMMENT '',
  `modified` DATETIME NOT NULL COMMENT '',
  `status` INT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '',
  `license_id` INT UNSIGNED NOT NULL COMMENT '',
  `user_id` CHAR(36) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_projects_licenses1_idx` (`license_id` ASC)  COMMENT '',
  INDEX `fk_projects_users1_idx` (`user_id` ASC)  COMMENT '',
  CONSTRAINT `projects_licenses`
    FOREIGN KEY (`license_id`)
    REFERENCES `elabs`.`licenses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `projects_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `elabs`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`project_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`project_users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` CHAR(36) NOT NULL COMMENT '',
  `project_id` CHAR(36) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_project_users_users1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_project_users_projects1_idx` (`project_id` ASC)  COMMENT '',
  CONSTRAINT `fk_project_users_projects1`
    FOREIGN KEY (`project_id`)
    REFERENCES `elabs`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `elabs`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `elabs`.`reports`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`reports` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NULL COMMENT '',
  `email` VARCHAR(45) NULL COMMENT '',
  `url` VARCHAR(255) NOT NULL COMMENT '',
  `reason` TEXT NOT NULL COMMENT '',
  `session` TEXT NULL COMMENT '',
  `created` DATETIME NOT NULL COMMENT '',
  `user_id` CHAR(36) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_reports_users1_idx` (`user_id` ASC)  COMMENT '',
  CONSTRAINT `fk_reports_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `elabs`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`tags` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `itemtag_count` INT NOT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`itemtags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`itemtags` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `model` VARCHAR(30) NOT NULL COMMENT '',
  `fkid` CHAR(36) NOT NULL COMMENT '',
  `tag_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_table1_tags1_idx` (`tag_id` ASC)  COMMENT '',
  CONSTRAINT `fk_table1_tags1`
    FOREIGN KEY (`tag_id`)
    REFERENCES `elabs`.`tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`files` (
  `id` CHAR(36) NOT NULL COMMENT '',
  `name` VARCHAR(45) NULL COMMENT '',
  `filename` VARCHAR(255) NOT NULL COMMENT '',
  `weight` INT NOT NULL COMMENT '',
  `description` VARCHAR(255) NULL COMMENT '',
  `mime` VARCHAR(50) NULL DEFAULT NULL COMMENT '',
  `created` DATETIME NOT NULL COMMENT '',
  `modified` DATETIME NOT NULL COMMENT '',
  `sfw` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '',
  `status` INT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '',
  `user_id` CHAR(36) NOT NULL COMMENT '',
  `license_id` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_files_users1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_files_licenses1_idx` (`license_id` ASC)  COMMENT '',
  CONSTRAINT `fk_files_licenses1`
    FOREIGN KEY (`license_id`)
    REFERENCES `elabs`.`licenses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_files_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `elabs`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elabs`.`itemfiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elabs`.`itemfiles` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `model` VARCHAR(30) NOT NULL COMMENT '',
  `fkid` CHAR(36) NOT NULL COMMENT '',
  `file_id` CHAR(36) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_itemfiles_files1_idx` (`file_id` ASC)  COMMENT '',
  CONSTRAINT `fk_itemfiles_files1`
    FOREIGN KEY (`file_id`)
    REFERENCES `elabs`.`files` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `elabs`.`licenses`
-- -----------------------------------------------------
START TRANSACTION;
USE `elabs`;
INSERT INTO `elabs`.`licenses` (`id`, `name`, `link`, `icon`, `post_count`, `project_count`, `file_count`) VALUES (1, 'CC BY-NC-SA 2.0', 'http://creativecommons.org/licenses/by-nc-sa/2.0/', 'creative-commons', 0, 0, 0);

COMMIT;
