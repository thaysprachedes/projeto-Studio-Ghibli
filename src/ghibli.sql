-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2020 às 00:44
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ghibli`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_filme` int(11) DEFAULT NULL,
  `data_emprestimo` datetime DEFAULT current_timestamp(),
  `data_devolucao_prevista` datetime DEFAULT NULL,
  `data_devolucao_efetiva` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id_usuario`, `id_filme`, `data_emprestimo`, `data_devolucao_prevista`, `data_devolucao_efetiva`) VALUES
(7, 7, '2020-11-29 19:30:00', '2020-11-30 00:00:00', '2020-11-29 18:11:21'),
(7, 7, '2020-11-29 19:30:00', '2020-11-30 00:00:00', NULL),
(7, 8, '2020-11-29 19:30:00', '2020-11-30 00:00:00', '2020-11-29 23:13:11'),
(7, 8, '2020-11-29 19:30:00', '2020-11-30 00:00:00', '2020-11-29 23:13:11'),
(7, 9, '2020-11-27 19:30:00', '2020-11-28 00:00:00', '2020-11-29 20:50:07'),
(7, 8, '2020-11-29 10:30:00', '2020-12-03 00:00:00', '2020-11-29 23:13:11'),
(7, 12, '2020-11-25 19:30:00', '2020-11-28 00:00:00', NULL),
(8, 13, '2020-11-22 19:30:00', '2020-11-25 00:00:00', '2020-11-29 23:24:33'),
(8, 14, '2020-11-29 19:30:00', '2020-12-01 00:00:00', NULL),
(8, 19, '2020-11-26 19:30:00', '2020-12-02 00:00:00', '2020-11-29 23:24:35'),
(7, 11, '2020-11-26 19:30:00', '2020-11-30 00:00:00', '2020-11-29 23:13:14'),
(7, 10, '2020-11-25 19:30:00', '2020-11-28 00:00:00', '2020-11-29 23:23:55'),
(7, 11, '2020-11-29 19:30:00', '2020-11-01 00:00:00', '2020-11-29 23:13:14'),
(7, 11, '2020-11-26 19:30:00', '2020-11-28 00:00:00', '2020-11-29 23:13:14'),
(7, 11, '2020-11-27 19:30:00', '2020-11-29 00:00:00', '2020-11-29 23:13:14'),
(7, 8, '2020-11-27 19:30:00', '2020-11-29 00:00:00', NULL),
(7, 11, '2020-11-29 19:30:00', '2020-12-01 00:00:00', NULL),
(7, 10, '2020-11-29 19:30:00', '2020-12-01 00:00:00', '2020-11-29 23:23:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme`
--

CREATE TABLE `filme` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` text NOT NULL,
  `ano` int(11) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `filme`
--

INSERT INTO `filme` (`id`, `titulo`, `ano`, `imagem`) VALUES
(8, 'O castelo no céu', 1986, 'O castelo no céu.jpg'),
(9, 'Túmulo dos Vagalumes', 1988, 'Túmulo dos Vagalumes.jpg'),
(10, 'Meu vizinho Totoro', 1988, 'Meu vizinho Totoro.jpg'),
(11, 'O serviço de entregas da Kiki', 1989, 'O serviço de entregas da Kiki.jpg'),
(12, 'Only Yesterday', 1991, 'Only Yesterday.jpg'),
(13, 'Porco Rosso', 1992, 'Porco Rosso.png'),
(14, 'Eu posso ouvir o oceano', 1993, 'Eu posso ouvir o oceano.png'),
(15, 'Pom Poko', 1994, 'Pom Poko.jpg'),
(16, 'O sussurro do coração', 1995, 'O sussurro do coração.jpg'),
(17, 'A princesa Mononoke', 1997, 'A princesa Mononoke.jpg'),
(18, 'Meus vizinhos,os Yamadas', 1999, 'Meus vizinhos,os Yamadas.jpg'),
(19, 'O reino dos gatos', 2002, 'O reino dos gatos.jpg'),
(20, 'O castelo animado', 2004, 'O castelo animado.jpg'),
(21, 'Contos de Terramar', 2006, 'Contos de Terramar.jpg'),
(22, 'Ponyo', 2008, 'Ponyo.jpg'),
(23, 'O Mundo Secreto de Arrietty', 2010, 'O Mundo Secreto de Arrietty.png'),
(24, 'A Colina das Papoilas', 2011, 'A Colina das Papoilas.png'),
(25, 'As Asas do Vento', 2013, 'As Asas do Vento.jpg'),
(26, 'O conto da princesa Kaguya', 2013, 'O conto da princesa Kaguya.jpg'),
(27, 'Memórias de Marnie', 2014, 'Memórias de Marnie.png'),
(28, 'A viagem de Chihiro', 2001, 'A viagem de Chihiro.jpg'),
(29, 'Earwig e a Bruxa', 2001, 'Earwig e a Bruxa.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adm` tinyint(1) NOT NULL,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `adm`, `nome`, `email`, `senha`, `data_nasc`) VALUES
(7, 1, 'Thays Prachedes ', 'thays@gmail.com', '12345', '1990-06-12'),
(8, 0, 'Kiki', 'kiki@entregas.gmail', '123', '2006-07-22');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filme`
--
ALTER TABLE `filme`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
