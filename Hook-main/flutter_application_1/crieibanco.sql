SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `hook_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hook_db`;

-- --------------------------------------------------------
-- Tabela: usuarios
-- --------------------------------------------------------
CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `email_verificado` tinyint(1) NOT NULL DEFAULT 0,
  `codigo_verificacao_hash` varchar(255) DEFAULT NULL,
  `codigo_verificacao_expira` datetime DEFAULT NULL,
  `codigo_recuperacao_hash` varchar(255) DEFAULT NULL,
  `codigo_recuperacao_expira` datetime DEFAULT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `tipo` enum('cliente','motorista') NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `placa_guincho` varchar(10) DEFAULT NULL,
  `tipo_guincho` enum('Leve','Pesado') DEFAULT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 0,
  `latitude_atual` decimal(10,7) DEFAULT NULL,
  `longitude_atual` decimal(10,7) DEFAULT NULL,
  `api_token` varchar(64) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_usuarios_tipo` (`tipo`),
  KEY `idx_usuarios_disponivel` (`disponivel`),
  KEY `idx_usuarios_api_token` (`api_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Usuários Teste (Senha: 123456)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `email_verificado`, `senha_hash`, `tipo`, `telefone`, `placa_guincho`, `disponivel`, `latitude_atual`, `longitude_atual`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Cliente Teste', 'cliente@hook.com', 1, '$2y$10$c4CjSfHhczIB6hnfENQ3MetgHqQUQfled2Cpsni/EMQvlEk.hWEnK', 'cliente', '11999999999', NULL, 0, NULL, NULL, 'db2d12b1ee33e51b304090609fa11002389458f50847a081c8b591d3ecadf050', '2026-08-18 15:07:17', '2026-08-19 12:11:29'),
(2, 'Motorista Teste', 'motorista@hook.com', 1, '$2y$10$AStf86l38sbxbHeyURw2L.kaPh6z2EuIBFVPWuwXOVtsOoLW3rt56', 'motorista', '11988888888', 'ABC1D23', 0, -23.5347000, -47.1188000, '6efc90925a8e0d6a3b33a1f55c6bcb3b2774743a6b76297882cf3d9ad6ae2beb', '2026-08-18 15:07:17', '2026-08-19 14:46:43');

-- --------------------------------------------------------
-- Tabela: veiculos
-- --------------------------------------------------------
CREATE TABLE `veiculos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('Carro','Moto','SUV') NOT NULL DEFAULT 'Carro',
  `marca` varchar(60) NOT NULL,
  `modelo` varchar(60) NOT NULL,
  `ano` smallint(5) UNSIGNED DEFAULT NULL,
  `placa` varchar(10) NOT NULL,
  `cor` varchar(30) DEFAULT NULL,
  `padrao` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_veiculos_usuario` (`usuario_id`),
  CONSTRAINT `fk_veiculos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabela: solicitacoes
-- --------------------------------------------------------
CREATE TABLE `solicitacoes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `motorista_id` int(10) UNSIGNED DEFAULT NULL,
  `veiculo_id` int(10) UNSIGNED NOT NULL,
  `tipo_reboque` enum('Guincho Leve','Guincho Pesado') NOT NULL,
  `forma_pagamento` enum('Pix','Dinheiro') NOT NULL,
  `precisa_troco` tinyint(1) NOT NULL DEFAULT 0,
  `troco_para` decimal(10,2) DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `valor_estimado` decimal(10,2) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `status` enum('buscando','aceito','a_caminho','no_local','em_atendimento','concluido','cancelado') NOT NULL DEFAULT 'buscando',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_solicitacoes_status` (`status`),
  KEY `idx_solicitacoes_cliente` (`cliente_id`),
  KEY `idx_solicitacoes_motorista` (`motorista_id`),
  KEY `idx_solicitacoes_created` (`created_at`),
  KEY `fk_solicitacoes_veiculo` (`veiculo_id`),
  CONSTRAINT `fk_solicitacoes_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_solicitacoes_motorista` FOREIGN KEY (`motorista_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_solicitacoes_veiculo` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabela: avaliacoes
-- --------------------------------------------------------
CREATE TABLE `avaliacoes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `solicitacao_id` int(10) UNSIGNED NOT NULL,
  `nota` tinyint(3) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `solicitacao_id` (`solicitacao_id`),
  CONSTRAINT `fk_avaliacoes_solicitacao` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabela: mensagens
-- --------------------------------------------------------
CREATE TABLE `mensagens` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `solicitacao_id` int(10) UNSIGNED NOT NULL,
  `remetente_id` int(10) UNSIGNED NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_mensagens_solicitacao` (`solicitacao_id`,`id`),
  KEY `idx_mensagens_remetente` (`remetente_id`),
  CONSTRAINT `fk_mensagens_remetente` FOREIGN KEY (`remetente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_mensagens_solicitacao` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;