DROP DATABASE IF EXISTS pizzanet2;
CREATE DATABASE IF NOT EXISTS pizzanet2;
USE pizzanet2;

CREATE TABLE cliente(
    id_cliente INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL,
    permissao INT NOT NULL DEFAULT 0,
    codigo_alteracao CHAR(32) DEFAULT 0
);


CREATE TABLE funcionario(
	id_funcionario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL,
    salario VARCHAR(50) NOT NULL,
    permissao INT NOT NULL DEFAULT 1,
    codigo_alteracao CHAR(32) DEFAULT 0
);

CREATE TABLE pizza(
	id_pizza INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    preco DECIMAL(5,2) NOT NULL
);

CREATE TABLE bebida(
	id_bebida INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    preco DECIMAL(5,2) NOT NULL
);

CREATE TABLE pedido(
	id_pedido INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    horario DATETIME NOT NULL,
    cod_cliente INT NOT NULL,
    cod_funcionario INT,
    status ENUM('aberto', 'pago') NOT NULL DEFAULT 'aberto',
    status_pedido INT NOT NULL DEFAULT 1,
    
    FOREIGN KEY(cod_cliente) REFERENCES cliente(id_cliente),
    FOREIGN KEY(cod_funcionario) REFERENCES funcionario(id_funcionario)
);


CREATE TABLE item_pedido(
	id_item_pedido INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo ENUM('pizza', 'bebida'),
	proporcao ENUM('inteira', 'meia') DEFAULT NULL,
    quantidade INT NOT NULL,
    preco_pedido DECIMAL(5,2),
    cod_pedido INT NOT NULL,
    cod_pizza1 INT DEFAULT NULL,
    cod_pizza2 INT DEFAULT NULL,
    cod_bebida INT DEFAULT NULL,
    
    FOREIGN KEY(cod_pedido) REFERENCES pedido(id_pedido),
    FOREIGN KEY(cod_bebida) REFERENCES bebida(id_bebida),
    FOREIGN KEY(cod_pizza1) REFERENCES pizza(id_pizza),
    FOREIGN KEY(cod_pizza2) REFERENCES pizza(id_pizza)
);


CREATE TABLE pagamento(
	id_pagamento INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    horario DATETIME NOT NULL,
    bandeira VARCHAR(50) NOT NULL,
    titular VARCHAR(100) NOT NULL,
    numero	VARCHAR(50) NOT NULL,
    validade VARCHAR(50) NOT NULL,
    total	DECIMAL(5,2) NOT NULL,
    cod_pedido INT,
    
     FOREIGN KEY(cod_pedido) REFERENCES pedido(id_pedido)
);


-- ---------------------------TRIGGERS

-- Preencher o valor do item_pedido
DELIMITER //
CREATE TRIGGER TRIGGER_PRECO_ITEM_PEDIDO BEFORE INSERT ON ITEM_PEDIDO
FOR EACH ROW 
BEGIN
IF NEW.TIPO = 'bebida' then 
	SET NEW.preco_pedido = (SELECT preco FROM bebida WHERE id_bebida = NEW.cod_bebida);
ELSE
	IF NEW.PROPORCAO = 'meia' then
		SET NEW.preco_pedido = (SELECT MAX(preco) FROM pizza WHERE id_pizza = NEW.cod_pizza1 OR id_pizza = NEW.cod_pizza2);
	ELSE
		SET NEW.preco_pedido = (SELECT preco FROM pizza WHERE id_pizza = NEW.cod_pizza1);
	end if;
END IF;
END;
//
DELIMITER ;

-- Dar baixa no pedido quando houver pagamento (status aberto para pago
CREATE TRIGGER TRIGGER_PAGAMENTO AFTER INSERT ON PAGAMENTO
FOR EACH ROW  
UPDATE PEDIDO SET STATUS = 'pago' WHERE ID_PEDIDO = NEW.COD_PEDIDO;

--  ---------------------------------------- INSERTS

-- CLIENTE
INSERT INTO cliente(nome, endereco, email, senha) VALUES
('Luis Miguel', 'Rua 1', 'lmiguelmarcelo1@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('João', 'Rua 2', 'joao@pizzanet.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('Jonas', 'Rua 3', 'jonas@pizzanet.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('Fernanda', 'Rua 4', 'fernanda@pizzanet.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('Gabriela', 'Rua 5', 'gabriela@pizzanet.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('Marcos', 'Rua 6', 'marcos@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- FUNCIONARIO
INSERT INTO funcionario(nome, email, salario, senha) VALUES
('Maria', 'maria@pizzanet.com', '2,000.00', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('José', 'jose@pizzanet.com', '2,000.00', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('Joana', 'joana@pizzanet.com', '2,000.00', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('Mario', 'mario@pizzanet.com', '2,000.00', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- PIZZA
INSERT INTO pizza(nome, descricao, preco) VALUES
('Frango', 'Mussarela, frango e catupiry', 29.00),
('Mussarela', 'Mussarela, presunto e tomate', 29.00),
('Calabresa', 'Mussarela, calabresa e azeitona', 31.00);

-- BEBIDA
INSERT INTO bebida(nome, descricao, preco) VALUES
('Coca-cola', '2 Litros', 9.00),
('Guarana Antarctica', '2 Litros', 7.00);

-- PEDIDO
INSERT INTO pedido(horario, cod_cliente, cod_funcionario) VALUES
('2017-06-10 20:50:13', 1, 1),
('2017-06-20 10:20:43', 2, 2),
('2019-06-12 20:50:13', 3, 3),
('2019-04-15 20:50:13', 6, 4),
('2019-04-17 20:50:13', 5, 4),
('2019-04-12 20:50:13', 4, 1),
('2017-03-29 20:50:13', 6, 1),
('2017-03-16 20:50:13', 1, 1),
('2017-03-11 20:50:13', 1, 2),
('2017-01-15 20:50:13', 5, NULL),
('2017-01-15 20:50:13', 2, NULL);

-- ITEM_PEDIDO
INSERT INTO item_pedido(cod_pedido, quantidade, proporcao, tipo, cod_pizza1, cod_pizza2, cod_bebida) VALUES
(1, 2, 1, 1, 1, null, NULL),
(2, 1, 2, 1, 2, 1, NULL),
(3, 2, 1, 1, 2, NULL, NULL),
(3, 5, 2, 1, 3, 2, NULL),
(4, 1, 1, 1, 2, NULL, NULL),
(4, 1, 2, 1, 2, 3, NULL),
(5, 3, 1, 1, 1, NULL, NULL),
(6, 2, 1, 1, 2, NULL, NULL),
(7, 3, 2, 1, 1, 2, NULL),
(8, 1, 2, 1, 1, 3, NULL),
(9, 1, 1, 1, 2, NULL, NULL),
(10, 2, 2, 1, 2, 1, NULL);

SELECT * FROM ITEM_PEDIDO;

-- PAGAMAMENTO
INSERT INTO pagamento(horario, bandeira, numero, validade, titular, total, cod_pedido) VALUES
('2017-06-10 20:50:13', 'MasterCard', '1111 1111 1111 1111', '11/11/2022', 'Luis Miguel', 58.00, 1),
('2017-02-20 10:20:43', 'Visa', '2222 2222 2222 2222', '12/10/2023', 'João', 29.00 , 2),
('2017-03-29 20:50:13', 'Visa', '3333 3333 3333 3333', '15/10/2024', 'Marcos', 87.00 , 7),
('2017-03-16 20:50:13', 'Visa', '4444 4444 4444 4444', '14/10/2026', 'Luis Miguel', 31.00 , 8),
('2019-06-12 20:50:13', 'Visa', '5555 5555 5555 5555', '10/10/2029', 'Jonas', 155.00, 3),
('2019-04-15 20:50:13', 'Visa', '6666 6666 6666 6666', '20/10/2021', 'Marcos', 29.00 , 4);

SELECT * FROM PEDIDO;

INSERT INTO cliente(nome, endereco, email, senha, permissao) VALUES
('Admin', 'Admin', 'pizzanetifsp@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2);

-- ---------------------------- VIEWS
CREATE OR REPLACE VIEW visao_item_pedido AS
    SELECT 
        id_item_pedido,
        pedido.id_pedido 'cod_pedido',
        item_pedido.quantidade 'quantidade',
        item_pedido.preco_pedido,
        tipo,
        IF(tipo = 'pizza',
            IF(p2.nome IS NOT NULL,
                CONCAT(p1.nome, ' e ', p2.nome),
                p1.nome),
            bebida.nome) 'item'
    FROM
        bebida
            RIGHT JOIN
        item_pedido ON cod_bebida = id_bebida
            LEFT JOIN
        pizza p1 ON p1.id_pizza = cod_pizza1
            LEFT JOIN
        pizza p2 ON p2.id_pizza = cod_pizza2
            INNER JOIN
        pedido ON pedido.id_pedido = item_pedido.cod_pedido;


CREATE OR REPLACE VIEW visao_pedido_aberto AS
    SELECT 
        pedido.cod_cliente,
        id_item_pedido,
        item_pedido.quantidade 'quantidade',
        item_pedido.preco_pedido,
        tipo,
        IF(tipo = 'pizza',
            IF(p2.nome IS NOT NULL,
                CONCAT(p1.nome, ' e ', p2.nome),
                p1.nome),
            bebida.nome) 'item'
    FROM
        bebida
            RIGHT JOIN
        item_pedido ON cod_bebida = id_bebida
            LEFT JOIN
        pizza p1 ON p1.id_pizza = cod_pizza1
            LEFT JOIN
        pizza p2 ON p2.id_pizza = cod_pizza2
            INNER JOIN
        pedido ON pedido.id_pedido = item_pedido.cod_pedido
            INNER JOIN
        cliente ON cliente.id_cliente = pedido.cod_cliente
    WHERE
        pedido.status = 'aberto';

CREATE OR REPLACE VIEW visao_funcionario_aprova_pedido AS
    SELECT 
        pedido.id_pedido,
        pedido.horario,
        cliente.nome,
        pedido.status,
        pagamento.total
    FROM
        cliente
            INNER JOIN
        pedido ON pedido.cod_cliente = cliente.id_cliente
            INNER JOIN
        pagamento ON pedido.id_pedido = pagamento.cod_pedido
    WHERE
        pedido.cod_funcionario IS NULL
            AND status = 'pago';
    
    
    CREATE OR REPLACE VIEW visao_historico_pedido AS
    SELECT 
        cod_pedido, pagamento.horario, total, nome, cod_cliente
    FROM
        pedido
            INNER JOIN
        pagamento ON id_pedido = cod_pedido
            INNER JOIN
        cliente ON cod_cliente = id_cliente;
      
      
      
      
	
-- 1.	Mostre os pedidos que foram feitos no período de 01/01/2019 a 31/01/2019.
		SELECT COUNT(id_pedido)'Numero de pedidos realizados entre 01/01/2019 a 31/01/2019'
        FROM pedido
        WHERE horario BETWEEN '2019-01-01' AND '2019-12-31';

-- 2.	Mostre a quantidade de pedidos que pediram pizza de muçarela.
		SELECT  COUNt(cod_pedido) 'Pedidos que contem pizza de mussarela'
        FROM item_pedido
        Where cod_pizza1 = 2 or cod_pizza2 = 2;

-- 3.	Faça uma visão que mostre Nome e e-mail do Cliente, Nome do Funcionário, nomes das pizzas solicitadas.

		CREATE OR REPLACE VIEW visao_ex3 AS
    SELECT 
        cliente.nome 'Cliente',
        cliente.email 'Email',
        funcionario.nome 'Funcionario',
        IF(p2.nome IS NOT NULL,
            CONCAT(p1.nome, ' e ', p2.nome),
            p1.nome) 'Pizza'
    FROM
        pedido
            INNER JOIN
        item_pedido ON cod_pedido = id_pedido
            INNER JOIN
        cliente ON cod_cliente = id_cliente
            INNER JOIN
        funcionario ON id_funcionario = cod_funcionario
            INNER JOIN
        pizza p1 ON cod_pizza1 = p1.id_pizza
            LEFT JOIN
        pizza p2 ON cod_pizza2 = p2.id_pizza;
        
-- 4.	Através de SELECT aninhados mostre os nomes dos clientes que pediram pizza frango em 2017.
		(SELECT nome
        FROM cliente INNER JOIN pedido
        ON cod_cliente=id_cliente
		AND horario= ANY (SELECT horario FROM pedido WHERE horario BETWEEN '2017-01-01' and '2017-12-31' AND id_pedido = ANY (SELECT cod_pedido FROM item_pedido WHERE cod_pizza1 =2 OR cod_pizza2 =2)));
        
-- 5.	Através de SELECT aninhados mostre os nomes dos clientes que estão com pagamento aberto.
		SELECT nome
        FROM cliente
        WHERE id_cliente = ANY(SELECT cod_cliente FROM pedido WHERE status='aberto');
        
-- 6.	Mostre o faturamento da Pizzaria no mês de março.
		SELECT SUM(total) 'Faturamento do mês de março'
        FROM pagamento
        WHERE MONTH(horario)=6;
        
-- 7.	Mostre o nome do funcionário que mais atendeu pedidos em abril.
		SELECT nome
        FROM funcionario INNER JOIN pedido
        on cod_funcionario=id_funcionario
        WHERE MONTH(horario)=6;

-- 8.	Mostre o nome do cliente que mais gastou na Pizzaria.
		SELECT nome
        FROM cliente
        INNER JOIN pedido ON cod_cliente=id_cliente
        INNER JOIN pagamento ON cod_pedido=id_pedido
        WHERE total >= all(SELECT total FROM pagamento);
        
        
-- 9.	Mostre quantos clientes distintos fizeram pedidos em janeiro.
		SELECT DISTINCT(nome)
        FROM cliente INNER JOIN pedido ON cod_cliente=id_cliente
        WHERE MONTH(horario)=1;
        
-- 10.	Mostre qual pedido teve mais pizzas solicitadas.
		
        SELECT id_pedido'Pedido com mais pizzas'
        FROM pedido INNER JOIN item_pedido ON cod_pedido=id_pedido
        WHERE quantidade >=all(select quantidade from item_pedido);


      
-- SELECT * FROM cliente;
-- SELECT * FROM funcionario;
-- SELECT * FROM pedido;
-- SELECT * FROM item_pedido;
-- SELECT * FROM pizza;
-- SELECT * FROM bebida;
-- SELECT * FROM pagamento;
-- SELECT * FROM visao_item_pedido;
-- SELECT * FROM visao_pedido_aberto;
-- SELECT * FROM visao_funcionario_aprova_pedido;
-- SELECT * FROM visao_funcionario_aprova_pedido;




