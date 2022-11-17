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

/* ========== Person ========== */

DROP TABLE IF EXISTS `Person`;
CREATE TABLE `Person` (
    `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome oficial da pessoa.',
    `birth` DATE NOT NULL COMMENT '(PT-BR) Data de nascimento da pessoa.',
    `gender` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Gênero.',
    `identity` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Número do Registro Geral (RG).',
    `document` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Número do Cadastro de Pessoa Física (CPF).',
    `nationality` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome do país em que a pessoa nasceu.',
    `naturalness` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome do estado em que a pessoa nasceu.',
    `place` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome da cidade em que a pessoa nasceu.',
    `maritial` VARCHAR(255) NOT NULL '(PT-BR) Estado civil da pessoa.',
    `professional` VARCHAR(255) NOT NULL '(PT-BR) Situação profissional da pessoa.',
    `academic` VARCHAR(255) NOT NULL '(PT-BR) Formação acadêmica da pessoa.',
    `email` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Endereço de e-mail da pessoa.',
    `phone` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Número de telefone da pessoa.',
    `cell` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Número de celular da pessoa.',
    PRIMARY KEY(`id`),
    UNIQUE INDEX (`document`),
    UNIQUE INDEX (`email`)
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados de uma pessoa.';

/* ========== /Person ========== */

/* ========== Address ========== */

DROP TABLE IF EXISTS `Address`;
CREATE TABLE `Address` (
    `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `person` INTEGER UNSIGNED NOT NULL,
    `state` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome do estado do endereço da pessoa.',
    `city` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome da cidade do endereço da pessoa.',
    `district` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome do bairro do endereço da pessoa.',
    `code` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Número do Código de Endereçamento Postal (CEP) do endereço da pessoa.',
    `location` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome da localidade do endereço da pessoa.',
    `number` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Número do endereço da pessoa.',
    `complement` VARCHAR(255) NULL COMMENT '(PT-BR) Descrição do complemento do endereço da pessoa.',
    PRIMARY KEY(`id`),
    FOREIGN KEY (`person`)
    REFERENCES `Person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados do endereço de uma pessoa.';

/* ========== Address ========== */

/* ========== Disability ========== */

DROP TABLE IF EXISTS `Disability`;
CREATE TABLE `Disability` (
    `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `person` INTEGER UNSIGNED NOT NULL,
    `ICD` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Número da Classificação Internacional de Doenças (CID).',
    `degree` TINYINT NOT NULL COMMENT '(PT-BR) Grau de deficiência da pessoa.',
    PRIMARY KEY(`id`),
    FOREIGN KEY (`person`)
    REFERENCES `Person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados da deficiência de uma pessoa.';

/* ========== Disability ========== */

/* ========== Dependent ========== */

DROP TABLE IF EXISTS `Dependent`;
CREATE TABLE `Dependent` (
    `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `person` INTEGER UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL COMMENT '(PT-BR) Nome do dependente da pessoa.',
    `birth` DATE NOT NULL COMMENT '(PT-BR) Data de nascimento do dependente da pessoa.',
    PRIMARY KEY(`id`),
    FOREIGN KEY (`person`)
    REFERENCES `Person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados dos dependentes de uma pessoa.';

/* ========== Dependent ========== */

/* ========== Associate ========== */

DROP TABLE IF EXISTS `Associate`;
CREATE TABLE `Associate` (
    `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `person` INTEGER UNSIGNED NOT NULL,
    `date` DATE NOT NULL COMMENT '(PT-BR) Data de filiação com a associação.',
    `active` BOOLEAN NOT NULL COMMENT '(PT-BR) Número da Condição de atividade do associado.',
    PRIMARY KEY(`id`),
    FOREIGN KEY (`person`)
    REFERENCES `Person` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = 'InnoDB'
DEFAULT CHARACTER SET `utf8mb4`
DEFAULT COLLATE `utf8mb4_unicode_ci`
COMMENT '(PT-BR) Usado para registrar os dados de associação de uma pessoa.';

/* ========== /Associate ========== */
