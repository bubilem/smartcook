-- MySQL Workbench Synchronization
-- Generated: 2023-12-21 09:38
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: bubil

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER SCHEMA `smartcook`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `difficulty` TINYINT(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'json list',
  `duration` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 60 COMMENT 'minutes',
  `price` TINYINT(4) NOT NULL DEFAULT 1 COMMENT 'json list',
  `decription` TEXT NULL DEFAULT NULL,
  `country` CHAR(2) NULL DEFAULT NULL COMMENT 'ISO 3166 alpha-2',
  `dttm` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `smartcook`.`ingredient` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_ingredient` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipe_id` SMALLINT(5) UNSIGNED NOT NULL,
  `ingredient_id` MEDIUMINT(8) UNSIGNED NOT NULL,
  `quantity` DECIMAL(10,3) NOT NULL,
  `unit` VARCHAR(3) NOT NULL COMMENT 'json list',
  `necessary` TINYINT(3) UNSIGNED NOT NULL DEFAULT 1,
  `order` TINYINT(3) UNSIGNED NOT NULL DEFAULT 1,
  `comment` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_recipe_has_ingredient_recipe_idx` (`recipe_id` ASC) VISIBLE,
  INDEX `fk_recipe_has_ingredient_ingredient1_idx` (`ingredient_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_has_ingredient_recipe`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipe_has_ingredient_ingredient1`
    FOREIGN KEY (`ingredient_id`)
    REFERENCES `smartcook`.`ingredient` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_tolerance` (
  `recipe_id` SMALLINT(5) UNSIGNED NOT NULL,
  `tolerance_id` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`tolerance_id`, `recipe_id`),
  INDEX `fk_recipe_has_tolerance_recipe1_idx` (`recipe_id` ASC) INVISIBLE,
  CONSTRAINT `fk_recipe_has_tolerance_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_category` (
  `recipe_id` SMALLINT(5) UNSIGNED NOT NULL,
  `recipe_category_id` SMALLINT(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`recipe_id`, `recipe_category_id`),
  INDEX `fk_recipe_has_recipe_category_recipe1_idx` (`recipe_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_has_recipe_category_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `smartcook`.`recipe_has_dish_category` (
  `recipe_id` SMALLINT(5) UNSIGNED NOT NULL,
  `dish_category_id` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`recipe_id`, `dish_category_id`),
  INDEX `fk_recipe_has_dish_category_recipe1_idx` (`recipe_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_has_dish_category_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `smartcook`.`recipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
