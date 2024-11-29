-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/11/2024 às 23:51
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_noticias`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbnoticia`
--

CREATE TABLE `tbnoticia` (
  `idnoticia` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `noticia` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbnoticia`
--

INSERT INTO `tbnoticia` (`idnoticia`, `titulo`, `data`, `noticia`, `foto`, `autor`) VALUES
(11, 'Carecas Brigam por Pente', '2025-04-01', 'A briga foi de arrancar os cabelos', '674a43419d913.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbusuarios`
--

INSERT INTO `tbusuarios` (`idusuario`, `nome`, `sexo`, `email`, `senha`) VALUES
(1, 'Dã', 'M', 'Da@gmail.com', '$2y$10$2Bkge54Mq.fcsIv3AUqBSu/4IuqbPioQ19nvZTbZy/R.mgbEgEV0m'),
(2, 'Kayllane', 'F', 'Kayllane@gmail.com', '$2y$10$Pe62xb1Z/qaaPo/baqZPke7RpQ50zNLs4KGHocH92W8ySiwWogFiW'),
(3, 'Misael', 'M', 'Misael@gmail.com', '$2y$10$247Pmhm6I7Rm0YDEuhtBYu1FGl6F9cJxUgs1oLxHat1Y4DEmnj8C6'),
(4, 'Matheus', 'M', 'Matheus@gmail.com', '$2y$10$QgAwW3cDGDsOQmfnto9Vq.pLrZekRmznvrEMWl/fbM8T3akk1a2lC'),
(5, 'Amanda', 'F', 'Amanda@gmail.com', '$2y$10$IRake4hn7pUHhoHt9cyhguVvBFGuB6BT2NE5UV4AsNdz/WyKpxrVq');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbnoticia`
--
ALTER TABLE `tbnoticia`
  ADD PRIMARY KEY (`idnoticia`),
  ADD KEY `autor` (`autor`);

--
-- Índices de tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbnoticia`
--
ALTER TABLE `tbnoticia`
  MODIFY `idnoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbnoticia`
--
ALTER TABLE `tbnoticia`
  ADD CONSTRAINT `tbnoticia_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `tbusuarios` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
