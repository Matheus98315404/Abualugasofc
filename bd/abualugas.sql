-- Adminer 4.8.1 MySQL 5.5.5-10.5.23-MariaDB-1:10.5.23+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `alugueis`;
CREATE TABLE `alugueis` (
  `id_aluguel` int(11) NOT NULL AUTO_INCREMENT,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `km_inicial` int(11) DEFAULT NULL,
  `km_final` int(11) DEFAULT NULL,
  `valor_km` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `pagamento` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_aluguel`),
  KEY `id_veiculo` (`id_veiculo`),
  KEY `id_funcionario` (`id_funcionario`),
  CONSTRAINT `alugueis_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`),
  CONSTRAINT `alugueis_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `alugueis` (`id_aluguel`, `id_veiculo`, `id_funcionario`, `data_inicio`, `data_fim`, `km_inicial`, `km_final`, `valor_km`, `valor_total`, `pagamento`) VALUES
(1,	1,	1,	'2023-01-01',	'2023-01-10',	50000,	50500,	2.00,	100.00,	'1'),
(2,	2,	2,	'2023-02-01',	'2023-02-05',	30000,	30200,	2.50,	50.00,	'1'),
(3,	3,	3,	'2023-03-01',	'2023-03-03',	10000,	10050,	3.00,	15.00,	'1'),
(4,	4,	4,	'2023-04-01',	'2023-04-05',	40000,	40200,	2.75,	55.00,	'1'),
(5,	5,	5,	'2023-05-01',	'2023-05-10',	25000,	25500,	2.25,	112.50,	'1'),
(6,	6,	6,	'2023-06-01',	'2023-06-03',	18000,	18200,	3.10,	31.00,	'1'),
(7,	7,	7,	'2023-07-01',	'2023-07-15',	35000,	35700,	2.90,	203.00,	'1'),
(8,	8,	8,	'2023-08-01',	'2023-08-08',	29000,	29300,	2.40,	72.00,	'1'),
(9,	9,	9,	'2023-09-01',	'2023-09-20',	42000,	42500,	2.80,	140.00,	'1'),
(10,	10,	10,	'2023-10-01',	'2023-10-05',	31000,	31200,	2.60,	52.00,	'1'),
(11,	11,	11,	'2023-11-01',	'2023-11-25',	38000,	38500,	2.70,	270.00,	'1'),
(12,	12,	12,	'2023-12-01',	'2023-12-12',	27000,	27300,	2.35,	70.50,	'1'),
(13,	13,	13,	'2024-01-01',	'2024-01-07',	32000,	32400,	2.45,	49.00,	'1'),
(14,	14,	14,	'2024-02-01',	'2024-02-03',	19000,	19100,	3.20,	32.00,	'1'),
(15,	15,	15,	'2024-03-01',	'2024-03-09',	40000,	40500,	2.85,	142.50,	'1'),
(16,	16,	16,	'2024-04-01',	'2024-04-14',	26000,	26500,	2.55,	153.00,	'1'),
(17,	17,	17,	'2024-05-01',	'2024-05-05',	35000,	35200,	2.95,	59.00,	'1'),
(18,	18,	18,	'2024-06-01',	'2024-06-18',	30000,	30500,	2.30,	115.00,	'1'),
(19,	19,	19,	'2024-07-01',	'2024-07-04',	37000,	37150,	2.65,	39.75,	'1'),
(20,	20,	20,	'2024-08-01',	'2024-08-10',	28000,	28200,	2.75,	55.00,	'1');

DROP TABLE IF EXISTS `clientealugueis`;
CREATE TABLE `clientealugueis` (
  `id_cliente` int(11) NOT NULL,
  `id_aluguel` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`,`id_aluguel`),
  KEY `id_aluguel` (`id_aluguel`),
  CONSTRAINT `clientealugueis_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `clientealugueis_ibfk_2` FOREIGN KEY (`id_aluguel`) REFERENCES `alugueis` (`id_aluguel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `carteira_motorista` varchar(20) NOT NULL,
  `validade_carteira` date NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cpf_cnpj` (`cpf_cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `clientes` (`id_cliente`, `nome`, `cpf_cnpj`, `endereco`, `telefone`, `email`, `carteira_motorista`, `validade_carteira`) VALUES
(1,	'João Silva',	'123.456.789-00',	'Rua A, 123',	'1111-1111',	'joao@gmail.com',	'ABC123456',	'2025-12-31'),
(2,	'Maria Oliveira',	'987.654.321-00',	'Rua B, 456',	'2222-2222',	'maria@gmail.com',	'DEF654321',	'2024-06-30'),
(3,	'Pedro Santos',	'456.789.123-00',	'Rua C, 789',	'3333-3333',	'pedro@gmail.com',	'GHI789123',	'2026-03-15'),
(4,	'Ana Souza',	'111.222.333-44',	'Av. X, 789',	'4444-4444',	'ana@gmail.com',	'JKL987654',	'2025-08-15'),
(5,	'Carlos Ferreira',	'222.333.444-55',	'Rua Y, 456',	'5555-5555',	'carlos@gmail.com',	'MNO123456',	'2024-11-30'),
(6,	'Mariana Costa',	'333.444.555-66',	'Rua Z, 321',	'6666-6666',	'mariana@gmail.com',	'PQR789012',	'2026-05-20'),
(7,	'Rafaela Lima',	'444.555.666-77',	'Av. W, 987',	'7777-7777',	'rafaela@gmail.com',	'STU345678',	'2023-09-10'),
(8,	'Rodrigo Vieira',	'555.666.777-88',	'Rua K, 654',	'8888-8888',	'rodrigo@gmail.com',	'VWX901234',	'2024-07-25'),
(9,	'Camila Santos',	'666.777.888-99',	'Av. M, 987',	'9999-9999',	'camila@gmail.com',	'YZA567890',	'2025-04-05'),
(10,	'Fernanda Oliveira',	'777.888.999-00',	'Rua D, 321',	'1010-1010',	'fernanda@gmail.com',	'BCD234567',	'2023-11-15'),
(11,	'Gustavo Ferreira',	'888.999.000-11',	'Av. E, 654',	'1212-1212',	'gustavo@gmail.com',	'EFG345678',	'2024-09-20'),
(12,	'Lucas Souza',	'999.000.111-22',	'Rua F, 987',	'1313-1313',	'lucas@gmail.com',	'HIJ456789',	'2025-06-30'),
(13,	'Patrícia Lima',	'000.111.222-33',	'Av. G, 456',	'1414-1414',	'patricia@gmail.com',	'KLM567890',	'2026-01-25'),
(14,	'Renato Costa',	'111.222.333-55',	'Rua H, 654',	'1515-1515',	'renato@gmail.com',	'NOP678901',	'2023-07-10'),
(15,	'Sandra Vieira',	'222.333.444-66',	'Av. I, 789',	'1616-1616',	'sandra@gmail.com',	'QRS789012',	'2024-04-15'),
(16,	'Thiago Santos',	'333.444.555-77',	'Rua J, 123',	'1717-1717',	'thiago@gmail.com',	'TUV890123',	'2025-09-05'),
(17,	'Vanessa Oliveira',	'444.555.666-88',	'Av. L, 987',	'1818-1818',	'vanessa@gmail.com',	'WXY901234',	'2026-02-20'),
(18,	'Roberto Silva',	'555.666.777-99',	'Rua N, 321',	'1919-1919',	'roberto@gmail.com',	'YZA012345',	'2023-12-01'),
(19,	'Carolina Souza',	'666.777.888-00',	'Av. O, 654',	'2020-2020',	'carolina@gmail.com',	'BCD123456',	'2024-10-10'),
(20,	'Lucas Pereira',	'777.888.999-11',	'Rua P, 987',	'2121-2121',	'lucas.pereira@gmail.com',	'EFG234567',	'2025-07-15');

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `cpf`, `telefone`, `email`) VALUES
(1,	'Felipe Matos',	'123.456.789-12',	'4444-4445',	'felipe2@gmail.com'),
(2,	'Gustavo Barbosa',	'987.654.321-23',	'5555-5556',	'gustavo2@gmail.com'),
(3,	'Wellison Ferreira',	'456.789.123-34',	'6666-6667',	'wellison2@gmail.com'),
(4,	'Joana Silva',	'111.222.333-44',	'7777-7777',	'joana@gmail.com'),
(5,	'Pedro Santos',	'555.666.777-88',	'8888-8888',	'pedro@gmail.com'),
(6,	'Ana Souza',	'999.888.777-66',	'9999-9999',	'ana@gmail.com'),
(7,	'Marcos Oliveira',	'333.444.555-99',	'0000-0000',	'marcos@gmail.com'),
(8,	'Carla Mendes',	'777.888.999-11',	'1111-1111',	'carla@gmail.com'),
(9,	'Lucas Fernandes',	'222.333.444-55',	'2222-2222',	'lucas@gmail.com'),
(10,	'Camila Costa',	'666.777.888-22',	'3333-3333',	'camila@gmail.com'),
(11,	'Roberto Almeida',	'444.555.666-77',	'4444-4444',	'roberto@gmail.com'),
(12,	'Amanda Silva',	'888.999.111-00',	'5555-5555',	'amanda@gmail.com'),
(13,	'Rodrigo Santos',	'222.333.555-88',	'6666-6666',	'rodrigo@gmail.com'),
(14,	'Renata Oliveira',	'777.888.222-33',	'7777-7877',	'renata@gmail.com'),
(15,	'Eduardo Costa',	'333.444.666-99',	'8888-8878',	'eduardo@gmail.com'),
(16,	'Sandra Lima',	'555.666.888-11',	'9999-9399',	'sandra@gmail.com'),
(17,	'Rafaela Souza',	'111.222.444-66',	'1234-5678',	'rafaela@gmail.com'),
(18,	'Bruno Martins',	'999.888.777-22',	'2345-6789',	'bruno@gmail.com'),
(19,	'Isabela Ferreira',	'444.555.999-33',	'3456-7890',	'isabela@gmail.com'),
(20,	'Paulo Rodrigues',	'888.999.222-44',	'4567-8901',	'paulo@gmail.com');

DROP TABLE IF EXISTS `pagamentos`;
CREATE TABLE `pagamentos` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluguel` int(11) DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `valor_pagamento` decimal(10,2) DEFAULT NULL,
  `metodo_pagamento` enum('Dinheiro','Cartao','Pix','Outro') DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `id_aluguel` (`id_aluguel`),
  CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`id_aluguel`) REFERENCES `alugueis` (`id_aluguel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pagamentos` (`id_pagamento`, `id_aluguel`, `data_pagamento`, `valor_pagamento`, `metodo_pagamento`) VALUES
(1,	1,	'2023-01-10',	100.00,	'Cartao'),
(2,	2,	'2023-02-05',	50.00,	'Dinheiro'),
(3,	3,	'2023-03-03',	15.00,	'Pix'),
(4,	4,	'2023-04-05',	55.00,	'Pix'),
(5,	5,	'2023-05-10',	112.50,	'Cartao'),
(6,	6,	'2023-06-03',	31.00,	'Dinheiro'),
(7,	7,	'2023-07-15',	203.00,	'Pix'),
(8,	8,	'2023-08-08',	72.00,	'Cartao'),
(9,	9,	'2023-09-20',	140.00,	'Cartao'),
(10,	10,	'2023-10-05',	52.00,	'Dinheiro'),
(11,	11,	'2023-11-25',	270.00,	'Pix'),
(12,	12,	'2023-12-12',	70.50,	'Pix'),
(13,	13,	'2024-01-07',	49.00,	'Cartao'),
(14,	14,	'2024-02-03',	32.00,	'Dinheiro'),
(15,	15,	'2024-03-09',	142.50,	'Pix'),
(16,	16,	'2024-04-14',	153.00,	'Pix'),
(17,	17,	'2024-05-05',	59.00,	'Cartao'),
(18,	18,	'2024-06-18',	115.00,	'Dinheiro'),
(19,	19,	'2024-07-04',	39.75,	'Pix'),
(20,	20,	'2024-08-10',	55.00,	'Pix');

DROP TABLE IF EXISTS `veiculos`;
CREATE TABLE `veiculos` (
  `id_veiculo` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(100) DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `cor` varchar(20) DEFAULT NULL,
  `km_atual` int(11) DEFAULT NULL,
  `tipo` enum('Carro','Moto') DEFAULT NULL,
  `airbag` tinyint(1) DEFAULT NULL,
  `num_bancos` int(11) DEFAULT NULL,
  `num_portas` int(11) DEFAULT NULL,
  `combustivel` enum('Gasolina','Etanol','Diesel','Flex','Eletrico','Hibrido') DEFAULT NULL,
  `cambio` enum('Manual','Automatico','CVT','DCT') DEFAULT NULL,
  `ar_condicionado` tinyint(1) DEFAULT NULL,
  `direcao` enum('Mecanica','Hidraulica','Eletrica') DEFAULT NULL,
  `som` tinyint(1) DEFAULT NULL,
  `bluetooth` tinyint(1) DEFAULT NULL,
  `gps` tinyint(1) DEFAULT NULL,
  `sensor_estacionamento` tinyint(1) DEFAULT NULL,
  `camera_re` tinyint(1) DEFAULT NULL,
  `disponivel` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id_veiculo`),
  UNIQUE KEY `placa` (`placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `veiculos` (`id_veiculo`, `modelo`, `marca`, `ano`, `placa`, `cor`, `km_atual`, `tipo`, `airbag`, `num_bancos`, `num_portas`, `combustivel`, `cambio`, `ar_condicionado`, `direcao`, `som`, `bluetooth`, `gps`, `sensor_estacionamento`, `camera_re`, `disponivel`) VALUES
(1,	'Civic',	'Honda',	2020,	'ABC-1234',	'Preto',	50000,	'Carro',	1,	5,	4,	'Gasolina',	'Automatico',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(2,	'Corolla',	'Toyota',	2021,	'DEF-5678',	'Branco',	30000,	'Carro',	1,	5,	4,	'Flex',	'CVT',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(3,	'Ninja',	'Kawasaki',	2019,	'GHI-9101',	'Verde',	10000,	'Moto',	0,	2,	0,	'Gasolina',	'Manual',	0,	'Mecanica',	1,	1,	0,	0,	0,	1),
(4,	'Gol',	'Volkswagen',	2018,	'JKL-2345',	'Prata',	40000,	'Carro',	0,	5,	4,	'Flex',	'Manual',	0,	'Mecanica',	0,	0,	0,	0,	0,	1),
(5,	'Fiesta',	'Ford',	2019,	'MNO-6789',	'Azul',	35000,	'Carro',	1,	5,	4,	'Flex',	'Automatico',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(6,	'CBR 600',	'Honda',	2020,	'PQR-1234',	'Vermelho',	15000,	'Moto',	0,	1,	0,	'Gasolina',	'Manual',	0,	'Mecanica',	0,	0,	0,	0,	0,	1),
(7,	'Fusion',	'Ford',	2022,	'STU-5678',	'Cinza',	25000,	'Carro',	1,	5,	4,	'Hibrido',	'CVT',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(8,	'S10',	'Chevrolet',	2021,	'VWX-9101',	'Prata',	20000,	'Carro',	1,	5,	4,	'Diesel',	'Automatico',	1,	'Hidraulica',	1,	1,	1,	1,	1,	1),
(9,	'Uno',	'Fiat',	2017,	'YZA-2345',	'Verde',	45000,	'Carro',	0,	5,	2,	'Flex',	'Manual',	0,	'Mecanica',	0,	0,	0,	0,	0,	1),
(10,	'HR-V',	'Honda',	2023,	'BCD-6789',	'Prata',	10000,	'Carro',	1,	5,	4,	'Flex',	'CVT',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(11,	'Golf',	'Volkswagen',	2020,	'EFG-1234',	'Preto',	28000,	'Carro',	1,	5,	4,	'Flex',	'Automatico',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(12,	'XRE 300',	'Honda',	2021,	'HIJ-5678',	'Vermelho',	18000,	'Moto',	0,	1,	0,	'Gasolina',	'Manual',	0,	'Mecanica',	0,	0,	0,	0,	0,	1),
(13,	'EcoSport',	'Ford',	2018,	'KLM-9101',	'Preto',	32000,	'Carro',	1,	5,	4,	'Flex',	'Automatico',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(14,	'Toro',	'Fiat',	2022,	'NOP-2345',	'Cinza',	15000,	'Carro',	1,	5,	4,	'Diesel',	'Automatico',	1,	'Hidraulica',	1,	1,	1,	1,	1,	1),
(15,	'Tracker',	'Chevrolet',	2020,	'QRS-6789',	'Branco',	26000,	'Carro',	1,	5,	4,	'Flex',	'CVT',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(16,	'MT-07',	'Yamaha',	2021,	'TUV-1234',	'Azul',	12000,	'Moto',	0,	2,	0,	'Gasolina',	'Manual',	0,	'Mecanica',	1,	1,	0,	0,	0,	1),
(17,	'Compass',	'Jeep',	2023,	'WXY-5678',	'Prata',	8000,	'Carro',	1,	5,	4,	'Flex',	'Automatico',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(18,	'Glide',	'Harley-Davidson',	2020,	'YZA-9101',	'Preto',	15000,	'Moto',	1,	2,	0,	'Gasolina',	'Manual',	0,	'Mecanica',	1,	1,	0,	0,	0,	1),
(19,	'Onix',	'Chevrolet',	2021,	'BCD-2345',	'Vermelho',	18000,	'Carro',	1,	5,	4,	'Flex',	'CVT',	1,	'Eletrica',	1,	1,	1,	1,	1,	1),
(20,	'Ranger',	'Ford',	2022,	'EFG-6789',	'Branco',	12000,	'Carro',	1,	5,	4,	'Diesel',	'Automatico',	1,	'Hidraulica',	1,	1,	1,	1,	1,	1),
(21,	'CB 1000R',	'Honda',	2019,	'HIJ-1234',	'Preto',	22000,	'Moto',	0,	1,	0,	'Gasolina',	'Manual',	0,	'Mecanica',	0,	0,	0,	0,	0,	1);

-- 2024-07-04 19:18:44

