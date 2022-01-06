-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 06-Jan-2022 às 19:45
-- Versão do servidor: 5.7.23-23
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `infras12_infrasil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `detalhes` text COLLATE utf8_unicode_ci NOT NULL,
  `ponte_id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` VALUES(1, '2021-11-16', '12:00:00', 'Agendamento de inspeção cadastral para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(2, '2022-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(3, '2023-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(4, '2024-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(5, '2025-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(6, '2026-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(7, '2027-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(8, '2028-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(9, '2029-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(10, '2030-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(11, '2031-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(12, '2032-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(13, '2033-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(14, '2034-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(15, '2035-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(16, '2036-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(17, '2037-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(18, '2038-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(19, '2039-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(20, '2040-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(21, '2041-11-16', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(22, '2026-11-16', '12:00:00', 'Agendamento de inspeção especial para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(23, '2031-11-16', '12:00:00', 'Agendamento de inspeção especial para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(24, '2036-11-16', '12:00:00', 'Agendamento de inspeção especial para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(25, '2041-11-16', '12:00:00', 'Agendamento de inspeção especial para a OAE 29', 29, 1);
INSERT INTO `agendamentos` VALUES(26, '2021-11-22', '12:00:00', 'Agendamento de inspeção cadastral para a OAE 30', 30, 4);
INSERT INTO `agendamentos` VALUES(27, '2022-11-22', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 30', 30, 4);
INSERT INTO `agendamentos` VALUES(28, '2023-11-22', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 30', 30, 4);
INSERT INTO `agendamentos` VALUES(29, '2024-11-22', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 30', 30, 4);
INSERT INTO `agendamentos` VALUES(30, '2025-11-22', '12:00:00', 'Agendamento de inspeção rotineira para a OAE 30', 30, 4);
INSERT INTO `agendamentos` VALUES(31, '2026-11-22', '12:00:00', 'Agendamento de inspeção especial para a OAE 30', 30, 4);
INSERT INTO `agendamentos` VALUES(32, '0000-00-00', '00:00:00', '', 29, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf_cnpj` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `datetime_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetime_atualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chave` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `complemento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `referencia` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` VALUES(1, 'Testes Infrasil', '2021-11-15', '04.335.072/090', 'Rua Ernesto de Marco', '(49) 99671-0442', 'mariotti@infrasil.com.br', '2021-11-15 11:25:36', '2021-11-15 11:25:36', '$2y$10$4pbZvUHhOrJOHA45ZcB88.KwNx1LyqeJ3Xw4CWHcA.TYwFwhuSDYC', '89803-660', 'Parque das Palmeiras', '335', 'E', 'teste', 'Chapecó', '');
INSERT INTO `clientes` VALUES(2, 'AGUIA', '2021-11-15', '21.341.234/123', 'teste', '(21) 32132-1321', 'admin@infrasil.com.br', '2021-11-16 20:14:24', '2021-11-16 20:14:24', '$2y$10$9OS0caQAJqAPJBVUfBT8G.SR5nj8Ebz.6RINokNvkhD9ZT9vmjCd6', '12341-234', 'teste', '123123', 'teste', 'teste', 'teste', 'teste');
INSERT INTO `clientes` VALUES(3, 'Eduarda Lauck Machado', '0000-00-00', '', '', '', 'eduarda.lauck@gmail.com', '2021-11-16 20:19:09', '2021-11-16 20:19:09', '$2y$10$6ifp3ziy5.w7f1NeCt7ao.p99iyPeJAcrHFImugzen7yegYw0NoRu', '', '', '', '', '', 'Curitiba', '');
INSERT INTO `clientes` VALUES(4, 'Jean Carlo da Campo', '0000-00-00', '', '', '', 'jeancarlos@ixcsoft.com.br', '2021-11-19 17:09:10', '2021-11-19 17:09:10', '$2y$10$NITxFBnJ9Lv0VzofGiexteqpYvvrzc.qG3LdV2e9uDxOwRT6rR2iC', '', '', '', '', '', 'Chapecó', 'UX da ICX Soft');
INSERT INTO `clientes` VALUES(5, 'Mateus Da Cruz', '0000-00-00', '', '', '', 'mateusarlindo@hotmail.com', '2021-11-30 11:22:17', '2021-11-30 11:22:17', '$2y$10$JlT.DLCs8Y6..Hs7qthyT.3nbAEe1Iki2tdQBt0hipwUrmDQyvMS6', '', '', '', '', '', '', 'Prefeitura Iraí');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens_inspecoes`
--

CREATE TABLE `imagens_inspecoes` (
  `id` int(11) NOT NULL,
  `inspecao_id` int(11) NOT NULL,
  `imagem` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens_pontes`
--

CREATE TABLE `imagens_pontes` (
  `id` int(11) NOT NULL,
  `ponte_id` int(11) NOT NULL,
  `imagem` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `imagens_pontes`
--

INSERT INTO `imagens_pontes` VALUES(209, 29, '$2y$10$D9fNgbTGv0AT64hDxfG2ye3lsBKPBM6gIKTLJkDJmJbeJo9TFD66e.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(210, 29, '$2y$10$e4nhAjPI_T0NoURgoU_9QeAwL7sLfo8qs5lJsMM7gsX6JVwJel8ti.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(211, 29, '$2y$10$XXBrsYbOIOFOkiT_hr_izOpEt7zfRTpmoR6MJ5br5yBNmffc5ur42.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(212, 29, '$2y$10$VibhuZRVoAuFeEJqwmAThOBU_mbNj_xcSTembze53anbvsEU38lI_.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(213, 29, '$2y$10$g8yJP5wjkyoAXbXNFt4oDuVMy5dp2Kag_3t_ftXF_irqKlbkLWyPa.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(214, 29, '$2y$10$1_ps0BUmZXMZzZ_HFt3wy_lvaKaXcEHySUUvwhULnsurl3BtM4aGy.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(215, 29, '$2y$10$e8v8KaNW3EeYtqxOmNM3ee7Mk72_qdA5VO_CtSIPQ8n7Yj0Feh6wq.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(216, 29, '$2y$10$ymGnbXcyeCLKieWBnm0IeOTX7mG70wr9XSjhDMTLMVsmQFDsAsOX2.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(217, 29, '$2y$10$6ekVT6DEJH37uwVeG6pWnOycQVb_2SrwTAzYhg1pPbvwrsz0QhGyW.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(218, 29, '$2y$10$YjdBQz8f2owkzxdXJlu0YuOZwEaMVKwsJhJxOX_wtkesFoCzYnPDu.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(219, 29, '$2y$10$Li5O5xItWfqT8YT1rgxnJeMllNQ_4EQbN5YHJtwvTlNSdK8yz1qFi.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(220, 29, '$2y$10$Fpy3nZEC2jiAJOnf3DWp8OjlWa48MEwSNwVT9NZFDmJzGS_5sCNQG.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(221, 29, '$2y$10$BR15qEPP4S3KU6Qkr2dTwOxmHO_rvBWmcXLzSMGQt5nk_91rAZVEK.jpeg', 0);
INSERT INTO `imagens_pontes` VALUES(222, 30, '$2y$10$nGB4y9T3HjfqOC9RNOXmtuK46NycqDackkWC8esmsuV4h6eJjuKAS.x-icon', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inspecoes`
--

CREATE TABLE `inspecoes` (
  `id` int(11) NOT NULL,
  `ponte_id` int(11) NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `data_inspecao` date DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `nota_indice_localizacao` decimal(10,2) DEFAULT NULL,
  `nota_indice_volume_trafego` decimal(10,2) DEFAULT NULL,
  `nota_indice_largura_oae` decimal(10,2) DEFAULT NULL,
  `nota_geometria_condicoes` decimal(10,2) DEFAULT NULL,
  `nota_acessos` decimal(10,2) DEFAULT NULL,
  `nota_cursos_agua` decimal(10,2) DEFAULT NULL,
  `nota_encontros_fundacoes` decimal(10,2) DEFAULT NULL,
  `nota_apoios_intermediarios` decimal(10,2) DEFAULT NULL,
  `nota_aparelhos_apoio` decimal(10,2) DEFAULT NULL,
  `nota_superestrutura` decimal(10,2) DEFAULT NULL,
  `nota_pista_rolamento` decimal(10,2) DEFAULT NULL,
  `nota_juntas_dilatacao` decimal(10,2) DEFAULT NULL,
  `nota_barreiras_guardacorpos` decimal(10,2) DEFAULT NULL,
  `nota_sinalizacao` decimal(10,2) DEFAULT NULL,
  `nota_instalacoes_util_publica` decimal(10,2) DEFAULT NULL,
  `nota_largura_plataforma` decimal(10,2) DEFAULT NULL,
  `nota_capacidade_carga` decimal(10,2) DEFAULT NULL,
  `nota_superficie_plataforma` decimal(10,2) DEFAULT NULL,
  `nota_pista_rolamento_fc` decimal(10,2) DEFAULT NULL,
  `nota_outros_fc` decimal(10,2) DEFAULT NULL,
  `nota_espaco_livre` decimal(10,2) DEFAULT NULL,
  `nota_localizacao_ponte` decimal(10,2) DEFAULT NULL,
  `nota_saude_fisica_ponte` decimal(10,2) DEFAULT NULL,
  `nota_outros_fi` decimal(10,2) DEFAULT NULL,
  `tipo_inspecao` enum('cadastral','rotineira','especial','extraordinaria') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Aberto','Avaliado') COLLATE utf8_unicode_ci DEFAULT 'Aberto',
  `obs` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `inspecoes`
--

INSERT INTO `inspecoes` VALUES(616, 29, 'Inspeção cadastral para a OAE 29', 'Inspeção cadastral para a OAE 29', '0000-00-00', 1, 5.00, 15.00, 3.00, 3.75, 4.00, 2.00, 2.50, 5.00, 5.00, 3.75, 2.00, 4.00, 3.00, 3.00, 3.00, 2.00, 2.00, 8.00, 1.00, 3.00, 1.00, 0.60, 0.80, 0.20, 'cadastral', 'Avaliado', 'Recomenda-se inspeção especializada em caráter emergencial.');
INSERT INTO `inspecoes` VALUES(617, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2022-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(618, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2023-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(619, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2024-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(620, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2025-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(621, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2026-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(622, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2027-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(623, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2028-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(624, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2029-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(625, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2030-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(626, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2031-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(627, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2032-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(628, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2033-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(629, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2034-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(630, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2035-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(631, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2036-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(632, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2037-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(633, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2038-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(634, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2039-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(635, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2040-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(636, 29, 'Inspeção rotineira automática para a OAE 29', 'Inspeção rotineira automática para a OAE 29', '2041-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rotineira', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(637, 29, 'Inspeção especial automática para a OAE 29', 'Inspeção especial automática para a OAE 29', '2026-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'especial', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(638, 29, 'Inspeção especial automática para a OAE 29', 'Inspeção especial automática para a OAE 29', '2031-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'especial', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(639, 29, 'Inspeção especial automática para a OAE 29', 'Inspeção especial automática para a OAE 29', '2036-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'especial', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(640, 29, 'Inspeção especial automática para a OAE 29', 'Inspeção especial automática para a OAE 29', '2041-11-16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'especial', 'Aberto', NULL);
INSERT INTO `inspecoes` VALUES(641, 30, 'Inspeção cadastral para a OAE 30', 'Inspeção cadastral para a OAE 30', '0000-00-00', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cadastral', 'Avaliado', '');
INSERT INTO `inspecoes` VALUES(642, 29, 'Inspeção automática gerada pelo agendamento ID: 32', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cadastral', 'Aberto', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontes`
--

CREATE TABLE `pontes` (
  `id` int(11) NOT NULL,
  `nome` text COLLATE utf8_unicode_ci,
  `descricao` text COLLATE utf8_unicode_ci,
  `via` text COLLATE utf8_unicode_ci,
  `data_construcao` date DEFAULT NULL,
  `trem_tipo` text COLLATE utf8_unicode_ci,
  `sentido` text COLLATE utf8_unicode_ci,
  `localizacao` text COLLATE utf8_unicode_ci,
  `latitude` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `projetista` text COLLATE utf8_unicode_ci,
  `construtor` text COLLATE utf8_unicode_ci,
  `comprimento_estrutura` decimal(8,2) DEFAULT NULL,
  `largura_estrutura` decimal(8,2) DEFAULT NULL,
  `largura_acostamento` decimal(8,2) DEFAULT NULL,
  `largura_refugio` decimal(8,2) DEFAULT NULL,
  `largura_passeio` decimal(8,2) DEFAULT NULL,
  `sistema_construtivo` text COLLATE utf8_unicode_ci,
  `natureza_transposicao` text COLLATE utf8_unicode_ci,
  `material_construcao` text COLLATE utf8_unicode_ci,
  `longitudinal_super` text COLLATE utf8_unicode_ci,
  `transversal_super` text COLLATE utf8_unicode_ci,
  `mesoestrutura_tipo` text COLLATE utf8_unicode_ci,
  `nro_vaos` int(11) DEFAULT NULL,
  `nro_apoios` int(11) DEFAULT NULL,
  `nro_pilares_apoio` int(11) DEFAULT NULL,
  `aparelhos_apoio` text COLLATE utf8_unicode_ci,
  `comprimento_vao_tipico` decimal(8,2) DEFAULT NULL,
  `comprimento_maior_vao` decimal(8,2) DEFAULT NULL,
  `altura_pilares` decimal(8,2) DEFAULT NULL,
  `juntas_dilatacao` text COLLATE utf8_unicode_ci,
  `encontros` int(11) DEFAULT NULL,
  `outras` text COLLATE utf8_unicode_ci,
  `caracteristicas_plani` text COLLATE utf8_unicode_ci,
  `nro_faixas` int(11) DEFAULT NULL,
  `acostamento` text COLLATE utf8_unicode_ci,
  `refugios` text COLLATE utf8_unicode_ci,
  `passeio` text COLLATE utf8_unicode_ci,
  `barreira_rigida` text COLLATE utf8_unicode_ci,
  `material_pavimento` text COLLATE utf8_unicode_ci,
  `pingadeiras` text COLLATE utf8_unicode_ci,
  `guarda_corpo` text COLLATE utf8_unicode_ci,
  `drenos` text COLLATE utf8_unicode_ci,
  `freq_passagem_carga` text COLLATE utf8_unicode_ci,
  `superestrutura` text COLLATE utf8_unicode_ci,
  `mesoestrutura` text COLLATE utf8_unicode_ci,
  `infraestrutura` text COLLATE utf8_unicode_ci,
  `aparelhos_apoio_anomalia` text COLLATE utf8_unicode_ci,
  `juntas_dilatacao_anomalia` text COLLATE utf8_unicode_ci,
  `encontros_anomalia` text COLLATE utf8_unicode_ci,
  `pavimento_anomalia` text COLLATE utf8_unicode_ci,
  `acostamento_refugio_anomalia` text COLLATE utf8_unicode_ci,
  `drenagem_anomalia` text COLLATE utf8_unicode_ci,
  `guarda_corpo_anomalia` text COLLATE utf8_unicode_ci,
  `barreira_defesa` text COLLATE utf8_unicode_ci,
  `taludes` text COLLATE utf8_unicode_ci,
  `iluminacao` text COLLATE utf8_unicode_ci,
  `sinalizacao` text COLLATE utf8_unicode_ci,
  `protecao_pilares` text COLLATE utf8_unicode_ci,
  `id_usuario` int(11) NOT NULL,
  `infraestrutura_anomalia` text COLLATE utf8_unicode_ci,
  `resumo` text COLLATE utf8_unicode_ci,
  `estado` text COLLATE utf8_unicode_ci,
  `cidade` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pontes`
--

INSERT INTO `pontes` VALUES(29, 'Ponte Comunidade São Pedro', '', 'Comunidade São Pedro, Iraí, RS', '0000-00-00', '', 'Duplo', 'Comunidade São Pedro', '27º 15\' 58\" S', '53º 10\' 75\" O', '', '', 10.20, 3.50, 0.00, 0.00, 0.00, 'Moldado no local', 'Superfície aquífera', 'Concreto armado', 'Contínua', 'Laje', 'Pilares parede', 3, 2, 1, '', 2.97, 2.97, 2.30, '', 0, NULL, 'Região ondulada, traçado tangente', 1, '', '', '', '', 'Concreto armado', '', '', 'Sim', 'Baixa', 'Guarda-rodas quebrado em algumas partes com armadu', 'Árvores e galhos encalhados nos pilares, erosão e ', '', '', '', 'Eflorescências, erosão acentuada com exposição da ', 'Erosão com armadura exposta, acessos da ponte em s', '', 'Alguns drenos entupidos', '', '', '', '', '', '', 1, '', 'Recomenda-se inspeção especializada em caráter emergencial.', 'rio_grande_do_sul', '4310504');
INSERT INTO `pontes` VALUES(30, 'Ponte', '', 'Local', '1996-02-12', 'tb450', '', 'Alecrim', '45', '54', 'Luis', 'Odebretch', 2.00, 12.00, 1.00, 1.00, 1.00, '', '', '', '', '', '', 0, 0, 0, '', 0.00, 0.00, 0.00, '', 0, NULL, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, '', 'top', 'rio_grande_do_sul', '4300307');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `chave` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('normal','admin','aguia') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` VALUES(1, 'aguia', 'aguia', '$2y$10$EDunD4N4R5yOAvLgJH38WeccvPSnnmNCJWpwpanJF1BFZGQ8uyLg6', 2, 'aguia', 'aguia');
INSERT INTO `usuarios` VALUES(2, 'Cleovir José Milani', 'cleovirMilani@teste.com', '$2y$10$TcxUhwyLedBPZ2kHpwOPF.5HixhhYUO8c6x.uL8EWajkrJCwygcki', 1, '$2y$10$4pbZvUHhOrJOHA45ZcB88.KwNx1LyqeJ3Xw4CWHcA.TYwFwhuSDYC', 'admin');
INSERT INTO `usuarios` VALUES(3, 'Eduarda Lauck Machado', 'eduarda.lauck@gmail.com', '$2y$10$y3JGLtCZUnhycOtpvJnXPePsjUAxFOEeDDZ6PNkeMgDTk/kCZ4wdO', 3, '$2y$10$6ifp3ziy5.w7f1NeCt7ao.p99iyPeJAcrHFImugzen7yegYw0NoRu', 'admin');
INSERT INTO `usuarios` VALUES(4, 'Jean Carlos da Campo', 'jeancarlos@ixcsoft.com.br', '$2y$10$SX.58x6FH5zTQ/LIBsRlweJJuD0/FrvSjY4sZYZOqsTQuWVm4/5x2', 4, '$2y$10$NITxFBnJ9Lv0VzofGiexteqpYvvrzc.qG3LdV2e9uDxOwRT6rR2iC', 'admin');
INSERT INTO `usuarios` VALUES(5, 'Mateus Da Cruz', 'mateusarlindo@hotmail.com', '$2y$10$beg2Eo9JUlPEbJVJ.YzEDe.ZvzGyRV1JkjojHbUBJT6PzmlFEU5/a', 5, '$2y$10$JlT.DLCs8Y6..Hs7qthyT.3nbAEe1Iki2tdQBt0hipwUrmDQyvMS6', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chave` (`chave`);

--
-- Índices para tabela `imagens_inspecoes`
--
ALTER TABLE `imagens_inspecoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imagens_pontes`
--
ALTER TABLE `imagens_pontes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `inspecoes`
--
ALTER TABLE `inspecoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pontes`
--
ALTER TABLE `pontes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `imagens_inspecoes`
--
ALTER TABLE `imagens_inspecoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagens_pontes`
--
ALTER TABLE `imagens_pontes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT de tabela `inspecoes`
--
ALTER TABLE `inspecoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;

--
-- AUTO_INCREMENT de tabela `pontes`
--
ALTER TABLE `pontes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
