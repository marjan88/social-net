-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "migrations" -------------------------------
CREATE TABLE `migrations` ( 
	`migration` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`batch` Int( 11 ) NOT NULL
 )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "password_resets" --------------------------
CREATE TABLE `password_resets` ( 
	`email` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`token` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`created_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
 )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "users" ------------------------------------
CREATE TABLE `users` ( 
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL, 
	`username` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`email` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`password` VarChar( 60 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`first_name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`last_name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`location` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
	`remember_token` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, 
	`created_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00', 
	`updated_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	 PRIMARY KEY ( `id` )
, 
	CONSTRAINT `users_email_unique` UNIQUE( `email` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- ---------------------------------------------------------


-- Dump data of "migrations" -------------------------------
INSERT INTO `migrations`(`migration`,`batch`) VALUES ( '2014_10_12_000000_create_users_table', '1' );
INSERT INTO `migrations`(`migration`,`batch`) VALUES ( '2014_10_12_100000_create_password_resets_table', '1' );
-- ---------------------------------------------------------


-- Dump data of "password_resets" --------------------------
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
INSERT INTO `users`(`id`,`username`,`email`,`password`,`first_name`,`last_name`,`location`,`remember_token`,`created_at`,`updated_at`) VALUES ( '1', 'maqla88', 'marjanvaradjanin@yahoo.com', '$2y$10$iWanBpDBIlXrGw4xirt5p.AiRk6vB3feDgLdfyp4j.4UnB29ldi..', 'Marjan', 'Varadjanin', 'Serbia', '9YITkt9cdRx3kYf6cW7OTb2Q25VhqCwUOvjADwcDN5g0WGzNGs3lmHSkgoPO', '2015-11-24 15:06:29', '2015-11-24 15:35:16' );
INSERT INTO `users`(`id`,`username`,`email`,`password`,`first_name`,`last_name`,`location`,`remember_token`,`created_at`,`updated_at`) VALUES ( '2', 'john_doe', 'john@doe.com', '$2y$10$wVGqslGnpwFlMWlG9IMsiOPpnRSjbDv5BK58w0N4bydZFa8f4eiTq', 'John', 'Doe', 'USA', '9l9wTwcofHjzmGZiEkefJympSIcP4mJI3K3ZiSBSuuPHAl0gnFhbjLXSmr3p', '2015-11-24 15:37:42', '2015-11-24 15:37:55' );
INSERT INTO `users`(`id`,`username`,`email`,`password`,`first_name`,`last_name`,`location`,`remember_token`,`created_at`,`updated_at`) VALUES ( '3', 'mark_smith', 'mark@smith.com', '$2y$10$ACgyIoqCs4Z/9y8IMwYTT.ImHUZJ6d8JxSLosRukhyLkgHiP4lm5i', 'Mark', 'Smith', 'Germany', '4lJ190RbVCOK8AmHYYhzWtG4w2u2SBh75t0uMMt9qGla1Bl12JfJRkgSmEZn', '2015-11-24 15:38:37', '2015-11-24 15:38:41' );
-- ---------------------------------------------------------


-- CREATE INDEX "password_resets_email_index" --------------
CREATE INDEX `password_resets_email_index` USING BTREE ON `password_resets`( `email` );
-- ---------------------------------------------------------


-- CREATE INDEX "password_resets_token_index" --------------
CREATE INDEX `password_resets_token_index` USING BTREE ON `password_resets`( `token` );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


