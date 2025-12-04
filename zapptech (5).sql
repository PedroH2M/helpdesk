-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2025 às 17:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `zapptech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `documento` varchar(14) NOT NULL,
  `telefone` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `documento`, `telefone`) VALUES
(27, 'Pedro', 'pedro@gmail.com', 'regrergerg', '511981981985'),
(28, 'Pedro', 'pedro@gmail.com', '19199819819195', '511981981985'),
(29, 'rrggerger', 'pedro@gmail.com', '54114881', '5181871871');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gestores`
--

CREATE TABLE `gestores` (
  `id` int(11) NOT NULL,
  `gestor` varchar(100) DEFAULT NULL,
  `senha_gestor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gestores`
--

INSERT INTO `gestores` (`id`, `gestor`, `senha_gestor`) VALUES
(1, 'admin', 'admin'),
(2, 'gestor', 'gestor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencias`
--

CREATE TABLE `ocorrencias` (
  `id` int(11) NOT NULL,
  `cliente` varchar(200) DEFAULT NULL,
  `tecnico` varchar(100) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `inicio` time DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `fim` time DEFAULT NULL,
  `motivo` varchar(500) DEFAULT NULL,
  `status_ocorrencia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ocorrencias`
--

INSERT INTO `ocorrencias` (`id`, `cliente`, `tecnico`, `data_inicio`, `inicio`, `data_fim`, `fim`, `motivo`, `status_ocorrencia`) VALUES
(56, 'Mario', 'admin', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 'Sei não', 'Finalizado'),
(57, 'João', 'admin', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 'Pendente'),
(58, 'Mario', 'admin', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', 'Finalizado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `matricula` varchar(150) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `funcao` varchar(150) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `senha_usuario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `matricula`, `nome`, `email`, `funcao`, `usuario`, `senha_usuario`) VALUES
(3, '89981981', 'Pedro', 'pedro@gmail.com', 'Gestor', 'Pedroh2m', '123456');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `gestores`
--
ALTER TABLE `gestores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `gestores`
--
ALTER TABLE `gestores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
