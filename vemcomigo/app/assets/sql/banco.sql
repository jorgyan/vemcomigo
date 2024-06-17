-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17/06/2024 às 14:01
-- Versão do servidor: 10.11.7-MariaDB-cll-lve
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u645578655_vemcomigo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`id`, `email`, `senha`) VALUES
(1, 'cleilton@vemcomigo.com', '@Estudio');

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `aluno_desde` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `email`, `telefone`, `aluno_desde`) VALUES
(2, 'Cristina Isabel', 'cristina.isabel@outlook.com', '27987654321', '2024-05-01'),
(4, 'Jorgyan Ribeiro', 'jorgyan.ribeiro@outlook.com', '27934567890', '2024-01-06'),
(5, 'Maria do Carmo Santos', 'maria.carmo.santos@gmail.com', '27945678901', '2023-12-04'),
(6, 'Lindeberg Alves', 'lindeberg.alves@outlook.com', '27956789012', '2024-02-14'),
(8, 'Carlos Souza', 'carlos.souza@outlook.com', '27978901234', '2024-01-12'),
(13, 'Paulo Cebin', 'paulo@cebin.com', '27996156155', '2024-06-16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `presencas`
--

CREATE TABLE `presencas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `presente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `presencas`
--

INSERT INTO `presencas` (`id`, `aluno_id`, `data`, `presente`) VALUES
(20, 2, '2024-01-02', 1),
(21, 2, '2024-01-09', 1),
(22, 2, '2024-01-18', 1),
(23, 2, '2024-02-22', 1),
(24, 2, '2024-02-29', 0),
(25, 2, '2024-03-05', 0),
(26, 2, '2024-03-07', 1),
(27, 2, '2024-03-14', 1),
(28, 2, '2024-03-19', 1),
(29, 2, '2024-03-21', 0),
(30, 2, '2024-03-28', 1),
(31, 2, '2024-04-02', 1),
(32, 2, '2024-04-04', 1),
(33, 2, '2024-04-09', 0),
(34, 2, '2024-04-25', 0),
(35, 2, '2024-05-23', 0),
(36, 2, '2024-05-30', 1),
(60, 4, '2024-01-02', 1),
(61, 4, '2024-01-09', 0),
(62, 4, '2024-01-11', 1),
(63, 4, '2024-01-16', 1),
(64, 4, '2024-01-23', 1),
(65, 4, '2024-01-25', 0),
(66, 4, '2024-02-08', 1),
(67, 4, '2024-02-13', 0),
(68, 4, '2024-02-22', 1),
(69, 4, '2024-03-07', 0),
(70, 4, '2024-03-12', 1),
(71, 4, '2024-03-21', 0),
(72, 4, '2024-03-26', 1),
(73, 4, '2024-03-28', 1),
(74, 4, '2024-04-02', 1),
(75, 4, '2024-04-04', 1),
(76, 4, '2024-04-09', 0),
(77, 4, '2024-04-16', 1),
(78, 4, '2024-04-18', 1),
(79, 4, '2024-05-07', 0),
(80, 4, '2024-05-14', 1),
(81, 4, '2024-05-16', 1),
(82, 4, '2024-05-21', 0),
(83, 4, '2024-05-28', 1),
(84, 5, '2024-01-02', 1),
(85, 5, '2024-01-09', 0),
(86, 5, '2024-01-16', 1),
(87, 5, '2024-01-23', 0),
(88, 5, '2024-01-25', 1),
(89, 5, '2024-02-01', 0),
(90, 5, '2024-02-13', 0),
(91, 5, '2024-02-15', 0),
(92, 5, '2024-02-22', 1),
(93, 5, '2024-02-27', 0),
(94, 5, '2024-02-29', 0),
(95, 5, '2024-03-07', 0),
(96, 5, '2024-03-12', 1),
(97, 5, '2024-03-14', 1),
(98, 5, '2024-03-19', 1),
(99, 5, '2024-03-26', 1),
(100, 5, '2024-04-09', 0),
(101, 5, '2024-04-16', 1),
(102, 5, '2024-04-18', 1),
(103, 5, '2024-05-14', 1),
(104, 5, '2024-05-16', 1),
(105, 5, '2024-05-21', 0),
(106, 5, '2024-05-23', 0),
(107, 5, '2024-05-30', 1),
(108, 6, '2024-01-02', 1),
(109, 6, '2024-01-09', 0),
(110, 6, '2024-01-16', 1),
(111, 6, '2024-01-18', 1),
(112, 6, '2024-01-23', 1),
(113, 6, '2024-01-25', 0),
(114, 6, '2024-01-30', 1),
(115, 6, '2024-02-01', 0),
(116, 6, '2024-02-06', 1),
(117, 6, '2024-02-15', 0),
(118, 6, '2024-02-20', 1),
(119, 6, '2024-02-22', 1),
(120, 6, '2024-02-27', 0),
(121, 6, '2024-02-29', 0),
(122, 6, '2024-03-12', 1),
(123, 6, '2024-03-26', 1),
(124, 6, '2024-04-04', 1),
(125, 6, '2024-04-16', 1),
(126, 6, '2024-04-23', 0),
(127, 6, '2024-04-25', 0),
(128, 6, '2024-04-30', 1),
(129, 6, '2024-05-07', 0),
(130, 6, '2024-05-09', 0),
(131, 6, '2024-05-21', 0),
(132, 6, '2024-05-23', 0),
(133, 6, '2024-05-28', 1),
(134, 6, '2024-05-30', 1),
(155, 8, '2024-01-02', 1),
(156, 8, '2024-01-04', 1),
(157, 8, '2024-01-11', 0),
(158, 8, '2024-01-16', 1),
(159, 8, '2024-01-18', 1),
(160, 8, '2024-01-23', 1),
(161, 8, '2024-01-30', 1),
(162, 8, '2024-02-01', 0),
(163, 8, '2024-02-13', 0),
(164, 8, '2024-02-15', 0),
(165, 8, '2024-02-27', 0),
(166, 8, '2024-02-29', 0),
(167, 8, '2024-03-05', 0),
(168, 8, '2024-03-07', 1),
(169, 8, '2024-03-21', 0),
(170, 8, '2024-03-26', 1),
(171, 8, '2024-03-28', 1),
(172, 8, '2024-04-02', 1),
(173, 8, '2024-04-11', 0),
(174, 8, '2024-04-30', 1),
(175, 8, '2024-05-16', 1),
(176, 8, '2024-05-23', 0),
(177, 8, '2024-05-28', 1),
(221, 2, '2024-06-16', 0),
(222, 6, '2024-06-16', 0),
(223, 8, '2024-06-16', 1),
(224, 4, '2024-06-16', 1),
(225, 5, '2024-06-16', 1),
(229, 2, '2024-06-16', 0),
(230, 6, '2024-06-16', 1),
(231, 8, '2024-06-16', 0),
(232, 4, '2024-06-16', 1),
(233, 5, '2024-06-16', 0),
(237, 2, '2024-06-16', 1),
(238, 6, '2024-06-16', 1),
(239, 8, '2024-06-16', 1),
(240, 4, '2024-06-16', 1),
(241, 5, '2024-06-16', 1),
(245, 2, '2024-06-16', 1),
(246, 6, '2024-06-16', 1),
(247, 8, '2024-06-16', 1),
(248, 4, '2024-06-16', 1),
(249, 5, '2024-06-16', 1),
(253, 13, '2024-06-16', 1),
(254, 2, '2024-06-16', 1),
(255, 6, '2024-06-16', 1),
(256, 8, '2024-06-16', 0),
(257, 4, '2024-06-16', 0),
(258, 5, '2024-06-16', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `presencas`
--
ALTER TABLE `presencas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `presencas`
--
ALTER TABLE `presencas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `presencas`
--
ALTER TABLE `presencas`
  ADD CONSTRAINT `presencas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
