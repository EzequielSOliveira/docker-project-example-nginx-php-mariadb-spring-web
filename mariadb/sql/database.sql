/*

. Database
. Person ([PT-BR] Pessoa)
. Natural ([PT-BR] Pessoa Física)
. Legal ([PT-BR] Pessoa Jurídica)
. Disability ([PT-BR] Dficiência)
. Dependent ([PT-BR] Dependente)

*/

/* ========== Database ========== */

DROP DATABASE IF EXISTS `CAPEDAC`;

CREATE DATABASE IF NOT EXISTS `CAPEDAC` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;

USE `CAPEDAC`;

/* ========== /Database ========== */

/* ========== Maritial ========== */

DROP TABLE IF EXISTS `Maritial`;
CREATE TABLE `Maritial` (
	`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(32) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`;

INSERT INTO `Maritial` (`id`, `name`) VALUE (1, 'Solteiro');
INSERT INTO `Maritial` (`id`, `name`) VALUE (2, 'Casado');
INSERT INTO `Maritial` (`id`, `name`) VALUE (3, 'Separado');
INSERT INTO `Maritial` (`id`, `name`) VALUE (4, 'Divorciado');
INSERT INTO `Maritial` (`id`, `name`) VALUE (5, 'Viúvo');
INSERT INTO `Maritial` (`id`, `name`) VALUE (6, 'Amasiado');

/* ========== /Maritial ========== */

/* ========== Professional ========== */

DROP TABLE IF EXISTS `Professional`;
CREATE TABLE `Professional` (
	`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(32) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`;

INSERT INTO `Professional` (`id`, `name`) VALUE (1, 'Desempregado');
INSERT INTO `Professional` (`id`, `name`) VALUE (2, 'Empregado');
INSERT INTO `Professional` (`id`, `name`) VALUE (3, 'Aposentado');
INSERT INTO `Professional` (`id`, `name`) VALUE (4, 'Autônomo');
INSERT INTO `Professional` (`id`, `name`) VALUE (5, 'Benefício Social');

/* ========== /Professional ========== */

/* ========== Academic ========== */

DROP TABLE IF EXISTS `Academic`;
CREATE TABLE `Academic` (
	`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(32) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`;

INSERT INTO `Academic` (`id`, `name`) VALUE (1, 'Não Alfabetizado');
INSERT INTO `Academic` (`id`, `name`) VALUE (2, 'Ensino Fundamental Incompleto');
INSERT INTO `Academic` (`id`, `name`) VALUE (3, 'Ensino Fundamental Completo');
INSERT INTO `Academic` (`id`, `name`) VALUE (4, 'Ensino Médio Incompleto');
INSERT INTO `Academic` (`id`, `name`) VALUE (5, 'Ensino Médio Completo');
INSERT INTO `Academic` (`id`, `name`) VALUE (6, 'Ensino Superior Incompleto');
INSERT INTO `Academic` (`id`, `name`) VALUE (7, 'Ensino Superior Completo');

/* ========== /Academic ========== */

/* ========== Sex ========== */

DROP TABLE IF EXISTS `Sex`;
CREATE TABLE `Sex` (
	`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(32) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`;

INSERT INTO `Sex` (`id`, `name`) VALUE (1, 'Masculino');
INSERT INTO `Sex` (`id`, `name`) VALUE (2, 'Feminino');
INSERT INTO `Sex` (`id`, `name`) VALUE (3, 'Outro');

/* ========== /Sex ========== */

/* ========== Status ========== */

DROP TABLE IF EXISTS `Status`;
CREATE TABLE `Status` (
	`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(16) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`;

INSERT INTO `Status` (`id`, `name`) VALUE (1, 'Ativo');
INSERT INTO `Status` (`id`, `name`) VALUE (2, 'Inativo');

/* ========== /Status ========== */

/* ========== Person ========== */

DROP TABLE IF EXISTS `Person`;
CREATE TABLE `Person` (
    `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL COMMENT '(PT-BR) Nome oficial da pessoa.',
    `birth` DATE NOT NULL COMMENT '(PT-BR) Data de nascimento da pessoa.',
    `sex` TINYINT UNSIGNED NOT NULL COMMENT '(PT-BR) Sexo.',
    `identity` VARCHAR(32) NOT NULL COMMENT '(PT-BR) Número do Registro Geral (RG).',
    `document` VARCHAR(11) NOT NULL COMMENT '(PT-BR) Número do Cadastro de Pessoa Física (CPF).',
    `nationality` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome do país em que a pessoa nasceu.',
    `naturalness` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome do estado em que a pessoa nasceu.',
    `place` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome da cidade em que a pessoa nasceu.',
    `maritial` TINYINT UNSIGNED NOT NULL COMMENT '(PT-BR) Estado civil da pessoa.',
    `professional` TINYINT UNSIGNED NOT NULL COMMENT '(PT-BR) Situação profissional da pessoa.',
    `academic` TINYINT UNSIGNED NOT NULL COMMENT '(PT-BR) Formação acadêmica da pessoa.',
    `email` VARCHAR(100) NOT NULL COMMENT '(PT-BR) Endereço de e-mail da pessoa.',
    `phone` VARCHAR(32) NOT NULL COMMENT '(PT-BR) Número de telefone da pessoa.',
    `cell` VARCHAR(32) NOT NULL COMMENT '(PT-BR) Número de celular da pessoa.',
    `country` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome do país do endereço da pessoa.',
    `state` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome do estado do endereço da pessoa.',
    `city` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome da cidade do endereço da pessoa.',
    `district` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome do bairro do endereço da pessoa.',
    `location` VARCHAR(64) NOT NULL COMMENT '(PT-BR) Nome da localidade do endereço da pessoa.',
    `number` VARCHAR(16) NOT NULL COMMENT '(PT-BR) Número do endereço da pessoa.',
    `code` VARCHAR(32) NOT NULL COMMENT '(PT-BR) Número do Código de Endereçamento Postal (CEP) do endereço da pessoa.',
    `complement` VARCHAR(100) NULL COMMENT '(PT-BR) Descrição do complemento do endereço da pessoa.',
    `status` TINYINT UNSIGNED NOT NULL DEFAULT '1' COMMENT '(PT-BR) Número da Condição de atividade do associado.',
    `date` DATE NOT NULL DEFAULT CURRENT_DATE COMMENT '(PT-BR) Data de filiação com a associação.',
    PRIMARY KEY(`id`),
    UNIQUE INDEX (`document`),
    UNIQUE INDEX (`email`),
    FOREIGN KEY (`sex`)
    REFERENCES `Sex` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`maritial`)
    REFERENCES `Maritial` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`professional`)
    REFERENCES `Professional` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`academic`)
    REFERENCES `Academic` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`status`)
    REFERENCES `Status` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados de uma pessoa.';

/* ========== /Person ========== */

/* ========== Dependent ========== */

DROP TABLE IF EXISTS `Dependent`;
CREATE TABLE `Dependent` (
    `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `person` TINYINT UNSIGNED NOT NULL,
    `name` VARCHAR(100) NOT NULL COMMENT '(PT-BR) Nome do dependente da pessoa.',
    `birth` DATE NOT NULL COMMENT '(PT-BR) Data de nascimento do dependente da pessoa.',
    `sex` TINYINT UNSIGNED NOT NULL COMMENT '(PT-BR) Gênero.',
    PRIMARY KEY(`id`),
    FOREIGN KEY (`person`)
    REFERENCES `Person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`sex`)
    REFERENCES `Sex` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados dos dependentes de uma pessoa.';

/* ========== Dependent ========== */

/* ========== Degree ========== */

DROP TABLE IF EXISTS `Degree`;
CREATE TABLE `Degree` (
	`id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(16) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`;

INSERT INTO `Degree` (`id`, `name`) VALUE (1, 'Baixo');
INSERT INTO `Degree` (`id`, `name`) VALUE (2, 'Médio');
INSERT INTO `Degree` (`id`, `name`) VALUE (3, 'Alto');

/* ========== /Degree ========== */

/* ========== Disability ========== */

DROP TABLE IF EXISTS `Disability`;
CREATE TABLE `Disability` (
    `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `person` TINYINT UNSIGNED NOT NULL,
    `name` VARCHAR(100) NOT NULL COMMENT '(PT-BR) Nome da deficiência.',
    `ICD` VARCHAR(16) NOT NULL COMMENT '(PT-BR) Número da Classificação Internacional de Doenças (CID).',
    `degree` TINYINT UNSIGNED NOT NULL COMMENT '(PT-BR) Grau de deficiência da pessoa.',
    PRIMARY KEY(`id`),
    FOREIGN KEY (`person`)
    REFERENCES `Person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`degree`)
    REFERENCES `Degree` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados da deficiência de uma pessoa.';

/* ========== Disability ========== */
