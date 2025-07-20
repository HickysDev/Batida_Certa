-- Cria o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS `batida_certa`
CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Seleciona o banco para uso
USE `batida_certa`;

-- Criação da tabela usuarios
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela jornada
CREATE TABLE `jornada` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `tempo_almoco` time DEFAULT '01:00:00',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `jornada_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criação da tabela pontos
CREATE TABLE `pontos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigousuario` int NOT NULL,
  `data` date NOT NULL,
  `tipo` enum('chegada','saida_almoco','volta_almoco','saida_dia') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hora` time NOT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `codigousuario` (`codigousuario`),
  CONSTRAINT `pontos_ibfk_1` FOREIGN KEY (`codigousuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
