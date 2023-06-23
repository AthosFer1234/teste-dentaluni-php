-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 22-Jun-2023 às 21:52
-- Versão do servidor: 5.7.23-23
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `processoSeletivo2023_Athos_Fernandez`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dentistas`
--

CREATE TABLE `dentistas` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cro` int(11) NOT NULL,
  `cro_uf` char(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dentistas`
--

INSERT INTO `dentistas` (`id`, `name`, `email`, `cro`, `cro_uf`) VALUES
(1, 'JESSIKA DANIELLA LAZAROTTO', 'jessikadaniella@dentaluni.com.br', 25362, 'PR'),
(2, 'THIAGO RODRIGO PASQUALOTTO', 'thiagorodrigo@dentaluni.com.br', 21405, 'PR'),
(3, 'FERNANDO ALMEIDA ROTHER', 'fernandoalmeida@dentaluni.com.br', 28264, 'PR'),
(4, 'ALEXANDRE OTAVIO PACCA DA SILVA MEDEIROS', 'alexandreotavio@dentaluni.com.br', 25451, 'PR'),
(5, 'DANIELLE FERRONATO DE SOUZA GOMIDE', 'danielleferronato@dentaluni.com.br', 11053, 'PR'),
(6, 'ERIKA LAZARO BRANCO', 'erikalazaro@dentaluni.com.br', 18711, 'PR'),
(7, 'FRANCIELE DE MELLO CORREA', 'francieledemello@dentaluni.com.br', 32971, 'PR'),
(8, 'GABRIELA MARCOLINA', 'gabrielamarcolina@dentaluni.com.br', 30253, 'PR'),
(9, 'NATHALIA DE MOURA BRIONES ZONATTO', 'nathaliademoura@dentaluni.com.br', 25119, 'PR'),
(10, 'VALENTINA OSORIO FLORES DE ARAUJO', 'valentinaosorio@dentaluni.com.br', 32631, 'PR'),
(11, 'VIVIANE FRANCO FREIRE DE SIQUEIRA PORTO', 'vivianefranco@dentaluni.com.br', 14637, 'PR'),
(12, 'ADALBERTO COSTA NETTO', 'adalbertocosta@dentaluni.com.br', 19773, 'PR'),
(13, 'ADRIANA DE MORAIS TAVARES DA SILVA', 'adrianademorais@dentaluni.com.br', 20359, 'PR'),
(14, 'ADRIANA FERNANDES WEFFORT HILBERT', 'adrianafernandes@dentaluni.com.br', 11060, 'PR'),
(15, 'ADRIANA GALLEGO DONDA CASAGRANDE', 'adrianagallego@dentaluni.com.br', 17784, 'PR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dentistas_especialidades`
--

CREATE TABLE `dentistas_especialidades` (
  `especialidade_id` int(11) DEFAULT NULL,
  `dentista_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dentistas_especialidades`
--

INSERT INTO `dentistas_especialidades` (`especialidade_id`, `dentista_id`) VALUES
(3, 1),
(3, 2),
(4, 2),
(5, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(15, 2),
(16, 2),
(18, 2),
(20, 2),
(3, 3),
(4, 3),
(3, 4),
(4, 4),
(5, 4),
(10, 4),
(14, 4),
(15, 4),
(16, 4),
(18, 4),
(3, 5),
(14, 5),
(15, 5),
(3, 6),
(4, 6),
(5, 6),
(15, 6),
(16, 6),
(18, 6),
(3, 7),
(4, 7),
(14, 7),
(15, 7),
(18, 7),
(3, 8),
(4, 8),
(18, 8),
(3, 9),
(3, 10),
(4, 10),
(14, 10),
(18, 10),
(3, 11),
(3, 12),
(4, 12),
(6, 12),
(12, 12),
(18, 12),
(3, 13),
(4, 13),
(9, 13),
(14, 13),
(15, 13),
(18, 13),
(20, 13),
(3, 14),
(10, 14),
(20, 14),
(3, 15),
(4, 15),
(15, 15),
(16, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `especialidades`
--

INSERT INTO `especialidades` (`id`, `nome`) VALUES
(1, 'Acupuntura'),
(2, 'Cirurgia e Traumatologia Bucomaxilofacial'),
(3, 'Clínico Geral'),
(4, 'Dentística'),
(5, 'Disfunção Temporomandibular e Dor Orofacial'),
(6, 'Endodontia'),
(7, 'Estomatologia'),
(8, 'Homeopatia'),
(9, 'Implantodontia'),
(10, 'Odontogeriatria'),
(11, 'Odontologia do Esporte'),
(12, 'Odontologia do Trabalho'),
(13, 'Odontologia Pacientes com Necessidades Especiais'),
(14, 'Odontopediatria'),
(15, 'Ortodontia'),
(16, 'Ortopedia Funcional dos Maxilares'),
(17, 'Patologia Bucal'),
(18, 'Periodontia'),
(19, 'Prótese Bucomaxilofacial'),
(20, 'Prótese Dentária'),
(21, 'Radiologia Odontológica e Imaginologia');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dentistas`
--
ALTER TABLE `dentistas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dentistas`
--
ALTER TABLE `dentistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
