-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 24-Jun-2019 às 22:44
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `pizzanet2`
--
CREATE DATABASE IF NOT EXISTS `pizzanet2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pizzanet2`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bebida`
--

CREATE TABLE IF NOT EXISTS `bebida` (
  `id_bebida` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `preco` decimal(5,2) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bebida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `bebida`
--

INSERT INTO `bebida` (`id_bebida`, `descricao`, `preco`, `nome`) VALUES
(1, '2,5 Litros', '8.00', 'Coca-Cola'),
(2, '2,5 Litos', '7.00', 'Guaraná Antarctica'),
(5, '800 Ml', '3.00', 'Cerveja Skol'),
(6, '2 Litros', '7.00', 'Pepsi'),
(7, '800 Ml', '4.00', 'Brahma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `permissao` int(11) NOT NULL DEFAULT '0',
  `codigo_alteracao` char(32) DEFAULT '0',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `endereco`, `email`, `senha`, `permissao`, `codigo_alteracao`) VALUES
(1, 'Luis Miguel', 'Rua 4', 'lmiguelmarcelo1@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 0, ''),
(2, 'Admin', 'admin', 'pizzanetifsp@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 2, NULL),
(3, 'João', 'Rua 1', 'joao@pizzanet.com', 'adcd7048512e64b48da55b027577886ee5a36350', 0, NULL),
(4, 'Julia', 'Rua 3', 'julia@pizzanet.com', 'adcd7048512e64b48da55b027577886ee5a36350', 0, NULL),
(5, 'Eduardo', 'Rua 2', 'eduardo@pizzanet.com', 'adcd7048512e64b48da55b027577886ee5a36350', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `salario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `permissao` int(11) NOT NULL DEFAULT '1',
  `codigo_alteracao` char(32) DEFAULT '0',
  PRIMARY KEY (`id_funcionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome`, `salario`, `email`, `senha`, `permissao`, `codigo_alteracao`) VALUES
(1, 'Maria', '2.000,00', 'maria@pizzanet.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, NULL),
(3, 'André', '2.000,00', 'andre@pizzanet.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, NULL),
(4, 'Ana', '2.000,00', 'ana@pizzanet.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE IF NOT EXISTS `item_pedido` (
  `cod_pedido` int(11) NOT NULL,
  `id_item_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `proporcao` enum('inteira','meia') DEFAULT NULL,
  `tipo` enum('pizza','bebida') DEFAULT NULL,
  `cod_pizza1` int(11) DEFAULT NULL,
  `cod_pizza2` int(11) DEFAULT NULL,
  `cod_bebida` int(11) DEFAULT NULL,
  `preco_pedido` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id_item_pedido`),
  KEY `cod_pedido` (`cod_pedido`),
  KEY `cod_pizza1` (`cod_pizza1`),
  KEY `cod_bebida` (`cod_bebida`),
  KEY `cod_pizza2` (`cod_pizza2`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`cod_pedido`, `id_item_pedido`, `quantidade`, `proporcao`, `tipo`, `cod_pizza1`, `cod_pizza2`, `cod_bebida`, `preco_pedido`) VALUES
(39, 46, 1, 'meia', 'pizza', 1, 2, NULL, '32.00'),
(39, 47, 2, 'inteira', 'pizza', 3, NULL, NULL, '31.00'),
(39, 48, 2, NULL, 'bebida', NULL, NULL, 1, '8.00'),
(40, 49, 1, 'inteira', 'pizza', 4, NULL, NULL, '31.00'),
(41, 50, 2, 'meia', 'pizza', 1, 4, NULL, '31.00'),
(41, 51, 1, NULL, 'bebida', NULL, NULL, 6, '7.00'),
(42, 52, 3, NULL, 'bebida', NULL, NULL, 7, '4.00'),
(42, 53, 3, 'inteira', 'pizza', 3, NULL, NULL, '31.00'),
(42, 54, 1, 'inteira', 'pizza', 5, NULL, NULL, '34.00'),
(43, 55, 2, 'inteira', 'pizza', 4, NULL, NULL, '31.00'),
(43, 56, 1, 'inteira', 'pizza', 3, NULL, NULL, '31.00'),
(43, 57, 1, NULL, 'bebida', NULL, NULL, 5, '3.00'),
(43, 58, 1, NULL, 'bebida', NULL, NULL, 2, '7.00');

--
-- Acionadores `item_pedido`
--
DROP TRIGGER IF EXISTS `TRIGGER_PRECO_ITEM_PEDIDO`;
DELIMITER //
CREATE TRIGGER `TRIGGER_PRECO_ITEM_PEDIDO` BEFORE INSERT ON `item_pedido`
 FOR EACH ROW BEGIN
IF NEW.TIPO = 'bebida' then 
	SET NEW.preco_pedido = (SELECT preco FROM bebida WHERE id_bebida = NEW.cod_bebida);
ELSE
	IF NEW.PROPORCAO = 'meia' then
		SET NEW.preco_pedido = (SELECT MAX(preco) FROM pizza WHERE id_pizza = NEW.cod_pizza1 OR id_pizza = NEW.cod_pizza2);
	ELSE
		SET NEW.preco_pedido = (SELECT preco FROM pizza WHERE id_pizza = NEW.cod_pizza1);
	end if;
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `horario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bandeira` varchar(50) NOT NULL,
  `titular` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `validade` varchar(10) NOT NULL,
  `total` varchar(100) NOT NULL,
  `cod_pedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `cod_pedido` (`cod_pedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`id_pagamento`, `horario`, `bandeira`, `titular`, `numero`, `validade`, `total`, `cod_pedido`) VALUES
(16, '2019-06-23 20:37:18', 'MasterCard', 'Luis Miguel', '1111 1111 1111 1111', '11/11/2022', 'R$ 110,00', 39),
(17, '2019-06-23 20:37:53', 'MasterCard', 'Luis Miguel', '1111 1111 1111 111', '11/11/2022', 'R$ 31,00', 40),
(18, '2019-06-23 20:38:49', 'Visa', 'João da silva', '2222 2222 2222 2222', '22/12/2022', 'R$ 69,00', 41),
(19, '2019-06-23 20:39:40', 'American', 'Julia da Silva', '3333 3333 3333 3333', '31/12/2022', 'R$ 139,00', 42),
(20, '2019-06-23 20:40:39', 'Elo', 'Eduardo Ribeiro', '4444 4444 4444 4444', '04/04/2022', 'R$ 103,00', 43);

--
-- Acionadores `pagamento`
--
DROP TRIGGER IF EXISTS `TRIGGER_PAGAMENTO`;
DELIMITER //
CREATE TRIGGER `TRIGGER_PAGAMENTO` AFTER INSERT ON `pagamento`
 FOR EACH ROW UPDATE PEDIDO SET STATUS = 'pago' WHERE ID_PEDIDO = NEW.COD_PEDIDO
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `horario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cod_cliente` int(11) DEFAULT NULL,
  `cod_funcionario` int(11) DEFAULT NULL,
  `status` enum('aberto','pago') NOT NULL DEFAULT 'aberto',
  `status_pedido` enum('Novo','Preparando','Rota de Entrega','Entregue') NOT NULL DEFAULT 'Novo',
  PRIMARY KEY (`id_pedido`),
  KEY `cod_cliente` (`cod_cliente`),
  KEY `cod_funcionario` (`cod_funcionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `horario`, `cod_cliente`, `cod_funcionario`, `status`, `status_pedido`) VALUES
(39, '2019-06-23 20:35:07', 1, NULL, 'pago', 'Rota de Entrega'),
(40, '2019-06-23 20:37:33', 1, NULL, 'pago', 'Entregue'),
(41, '2019-06-23 20:38:14', 3, NULL, 'pago', 'Rota de Entrega'),
(42, '2019-06-23 20:38:58', 4, NULL, 'pago', 'Preparando'),
(43, '2019-06-23 20:39:55', 5, NULL, 'pago', 'Novo');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pedido_aberto`
--
CREATE TABLE IF NOT EXISTS `pedido_aberto` (
`ID_PEDIDO` int(11)
,`ID_ITEM_PEDIDO` int(11)
,`STATUS` enum('aberto','pago')
,`HORARIO` datetime
,`NOME_DO_CLIENTE` varchar(50)
,`NOME DO FUNCIONARIO` varchar(50)
,`QUANTIDADE` int(11)
,`PROPORCAO` enum('inteira','meia')
,`PIZZA 1` varchar(50)
,`PRECO PIZZA 1` decimal(5,2)
,`PIZZA 2` varchar(50)
,`PRECO PIZZA 2` decimal(5,2)
,`TOTAL` decimal(15,2)
);
-- --------------------------------------------------------

--
-- Estrutura da tabela `pizza`
--

CREATE TABLE IF NOT EXISTS `pizza` (
  `id_pizza` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_pizza`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `pizza`
--

INSERT INTO `pizza` (`id_pizza`, `descricao`, `nome`, `preco`) VALUES
(1, 'Mussarela, Frango e Catupiry', 'Frango Catupiry', '29.00'),
(2, 'Mussarela, Parmesão, Gorgonzola e Provolone', 'Quatro Queijos', '32.00'),
(3, 'Molho, Mussarela, Tomate e Orégano', 'Mussarela', '31.00'),
(4, 'Mussarela, Brócolis, Catupiry e Orégano', 'Brócolis', '31.00'),
(5, 'Mussarela, Palmito, Tomate e Orégano', 'Palmito', '34.00'),
(6, 'Mussarela, Tomate, Parmesão, Azaeitona e Orégano', 'Napolitana', '34.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `visao_funcionario_aprova_pedido`
--
CREATE TABLE IF NOT EXISTS `visao_funcionario_aprova_pedido` (
`id_pedido` int(11)
,`nome` varchar(50)
,`horario` datetime
,`total` varchar(100)
,`status_pedido` enum('Novo','Preparando','Rota de Entrega','Entregue')
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `visao_historico_pedido`
--
CREATE TABLE IF NOT EXISTS `visao_historico_pedido` (
`cod_pedido` int(11)
,`horario` datetime
,`total` varchar(100)
,`nome` varchar(50)
,`cod_cliente` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `visao_item_pedido`
--
CREATE TABLE IF NOT EXISTS `visao_item_pedido` (
`id_item_pedido` int(11)
,`cod_pedido` int(11)
,`quantidade` int(11)
,`preco_pedido` decimal(5,2)
,`tipo` enum('pizza','bebida')
,`item` varchar(103)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `visao_pedido_aberto`
--
CREATE TABLE IF NOT EXISTS `visao_pedido_aberto` (
`cod_cliente` int(11)
,`id_item_pedido` int(11)
,`quantidade` int(11)
,`preco_pedido` decimal(5,2)
,`tipo` enum('pizza','bebida')
,`item` varchar(103)
);
-- --------------------------------------------------------

--
-- Structure for view `pedido_aberto`
--
DROP TABLE IF EXISTS `pedido_aberto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pedido_aberto` AS select `pedido`.`id_pedido` AS `ID_PEDIDO`,`item_pedido`.`id_item_pedido` AS `ID_ITEM_PEDIDO`,`pedido`.`status` AS `STATUS`,`pedido`.`horario` AS `HORARIO`,`cliente`.`nome` AS `NOME_DO_CLIENTE`,`funcionario`.`nome` AS `NOME DO FUNCIONARIO`,`item_pedido`.`quantidade` AS `QUANTIDADE`,`item_pedido`.`proporcao` AS `PROPORCAO`,`p1`.`nome` AS `PIZZA 1`,`p1`.`preco` AS `PRECO PIZZA 1`,`p2`.`nome` AS `PIZZA 2`,`p2`.`preco` AS `PRECO PIZZA 2`,(`item_pedido`.`quantidade` * `item_pedido`.`preco_pedido`) AS `TOTAL` from (((((`item_pedido` join `pedido` on((`item_pedido`.`cod_pedido` = `pedido`.`id_pedido`))) join `cliente` on((`cliente`.`id_cliente` = `pedido`.`cod_cliente`))) join `funcionario` on((`pedido`.`cod_funcionario` = `funcionario`.`id_funcionario`))) join `pizza` `p1` on((`p1`.`id_pizza` = `item_pedido`.`cod_pizza1`))) left join `pizza` `p2` on((`p2`.`id_pizza` = `item_pedido`.`cod_pizza2`))) where (`pedido`.`status` = 'aberto') order by `pedido`.`id_pedido`,`item_pedido`.`id_item_pedido`;

-- --------------------------------------------------------

--
-- Structure for view `visao_funcionario_aprova_pedido`
--
DROP TABLE IF EXISTS `visao_funcionario_aprova_pedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visao_funcionario_aprova_pedido` AS select `pedido`.`id_pedido` AS `id_pedido`,`cliente`.`nome` AS `nome`,`pagamento`.`horario` AS `horario`,`pagamento`.`total` AS `total`,`pedido`.`status_pedido` AS `status_pedido` from ((`pedido` join `cliente` on((`cliente`.`id_cliente` = `pedido`.`cod_cliente`))) join `pagamento` on((`pagamento`.`cod_pedido` = `pedido`.`id_pedido`))) where (isnull(`pedido`.`cod_funcionario`) and (`pedido`.`status` = 'pago'));

-- --------------------------------------------------------

--
-- Structure for view `visao_historico_pedido`
--
DROP TABLE IF EXISTS `visao_historico_pedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visao_historico_pedido` AS select `pagamento`.`cod_pedido` AS `cod_pedido`,`pagamento`.`horario` AS `horario`,`pagamento`.`total` AS `total`,`cliente`.`nome` AS `nome`,`pedido`.`cod_cliente` AS `cod_cliente` from ((`pedido` join `pagamento` on((`pagamento`.`cod_pedido` = `pedido`.`id_pedido`))) join `cliente` on((`cliente`.`id_cliente` = `pedido`.`cod_cliente`)));

-- --------------------------------------------------------

--
-- Structure for view `visao_item_pedido`
--
DROP TABLE IF EXISTS `visao_item_pedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visao_item_pedido` AS select `item_pedido`.`id_item_pedido` AS `id_item_pedido`,`pedido`.`id_pedido` AS `cod_pedido`,`item_pedido`.`quantidade` AS `quantidade`,`item_pedido`.`preco_pedido` AS `preco_pedido`,`item_pedido`.`tipo` AS `tipo`,if((`item_pedido`.`tipo` = 'pizza'),if((`p2`.`nome` is not null),concat(`p1`.`nome`,' e ',`p2`.`nome`),`p1`.`nome`),`bebida`.`nome`) AS `item` from ((((`item_pedido` left join `bebida` on((`item_pedido`.`cod_bebida` = `bebida`.`id_bebida`))) left join `pizza` `p1` on((`p1`.`id_pizza` = `item_pedido`.`cod_pizza1`))) left join `pizza` `p2` on((`p2`.`id_pizza` = `item_pedido`.`cod_pizza2`))) join `pedido` on((`pedido`.`id_pedido` = `item_pedido`.`cod_pedido`)));

-- --------------------------------------------------------

--
-- Structure for view `visao_pedido_aberto`
--
DROP TABLE IF EXISTS `visao_pedido_aberto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visao_pedido_aberto` AS select `pedido`.`cod_cliente` AS `cod_cliente`,`item_pedido`.`id_item_pedido` AS `id_item_pedido`,`item_pedido`.`quantidade` AS `quantidade`,`item_pedido`.`preco_pedido` AS `preco_pedido`,`item_pedido`.`tipo` AS `tipo`,if((`item_pedido`.`tipo` = 'pizza'),if((`p2`.`nome` is not null),concat(`p1`.`nome`,' e ',`p2`.`nome`),`p1`.`nome`),`bebida`.`nome`) AS `item` from (((((`item_pedido` left join `bebida` on((`item_pedido`.`cod_bebida` = `bebida`.`id_bebida`))) left join `pizza` `p1` on((`p1`.`id_pizza` = `item_pedido`.`cod_pizza1`))) left join `pizza` `p2` on((`p2`.`id_pizza` = `item_pedido`.`cod_pizza2`))) join `pedido` on((`pedido`.`id_pedido` = `item_pedido`.`cod_pedido`))) join `cliente` on((`cliente`.`id_cliente` = `pedido`.`cod_cliente`))) where (`pedido`.`status` = 'aberto');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `item_pedido_ibfk_1` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`id_pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pedido_ibfk_2` FOREIGN KEY (`cod_pizza1`) REFERENCES `pizza` (`id_pizza`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pedido_ibfk_3` FOREIGN KEY (`cod_bebida`) REFERENCES `bebida` (`id_bebida`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pedido_ibfk_4` FOREIGN KEY (`cod_pizza2`) REFERENCES `pizza` (`id_pizza`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`id_pedido`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`cod_funcionario`) REFERENCES `funcionario` (`id_funcionario`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
