-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/04/2024 às 22:52
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdatualizado`
--
CREATE DATABASE IF NOT EXISTS `bdatualizado` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdatualizado`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fechadura`
--

CREATE TABLE `fechadura` (
  `idFechadura` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `pin` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fechadura`
--

INSERT INTO `fechadura` (`idFechadura`, `nome`, `pin`, `idUser`) VALUES
(1, 'Sala', 1, 5),
(2, 'Quarto', 2, 5),
(4, 'Portao', 44, 3),
(9, 'testeFechadura', 123456, 3),
(13, 'teste23', 2586, 6),
(16, 'mamaco', 2006, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUser` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` char(11) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUser`, `nome`, `cpf`, `senha`) VALUES
(3, 'teste', '12345678911', '123456'),
(5, 'teste2', '12345678910', '23185'),
(6, 'rodriago', '12345678918', '2511');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usufechadura`
--

CREATE TABLE `usufechadura` (
  `idRelacao` int(11) NOT NULL,
  `codUser` int(11) NOT NULL,
  `codFechadura` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `horario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usufechadura`
--

INSERT INTO `usufechadura` (`idRelacao`, `codUser`, `codFechadura`, `estado`, `horario`) VALUES
(1, 3, 2, 0, '2024-04-10 18:14:41'),
(2, 3, 2, 1, '2024-04-10 18:04:38'),
(11, 3, 1, 1, '2024-04-11 18:02:32'),
(12, 3, 2, 0, '2024-04-11 18:07:18'),
(13, 3, 2, 1, '2024-04-11 18:07:34');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `fechadura`
--
ALTER TABLE `fechadura`
  ADD PRIMARY KEY (`idFechadura`),
  ADD UNIQUE KEY `pin` (`pin`),
  ADD UNIQUE KEY `pin_2` (`pin`),
  ADD KEY `fk_idUser` (`idUser`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `CPF` (`cpf`);

--
-- Índices de tabela `usufechadura`
--
ALTER TABLE `usufechadura`
  ADD PRIMARY KEY (`idRelacao`),
  ADD KEY `codUser` (`codUser`),
  ADD KEY `codFechadura` (`codFechadura`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fechadura`
--
ALTER TABLE `fechadura`
  MODIFY `idFechadura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usufechadura`
--
ALTER TABLE `usufechadura`
  MODIFY `idRelacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `fechadura`
--
ALTER TABLE `fechadura`
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUser`) REFERENCES `usuario` (`idUser`);

--
-- Restrições para tabelas `usufechadura`
--
ALTER TABLE `usufechadura`
  ADD CONSTRAINT `usufechadura_ibfk_1` FOREIGN KEY (`codUser`) REFERENCES `usuario` (`idUser`),
  ADD CONSTRAINT `usufechadura_ibfk_2` FOREIGN KEY (`codFechadura`) REFERENCES `fechadura` (`idFechadura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
