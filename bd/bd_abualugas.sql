-- -----------------------------------------------------
-- Schema bd_abualugas
-- -----------------------------------------------------

-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS `bd_abualugas` DEFAULT CHARACTER SET utf8mb4;
USE `bd_abualugas`;

-- -----------------------------------------------------
-- Table `bd_abualugas`.`funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_abualugas`.`funcionarios` (
  `id_funcionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `cpf` VARCHAR(20) NULL DEFAULT NULL,
  `telefone` VARCHAR(20) NULL DEFAULT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE INDEX `cpf` (`cpf` ASC) VISIBLE
) ENGINE=InnoDB
AUTO_INCREMENT=21
DEFAULT CHARACTER SET=utf8mb4;

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `cpf`, `telefone`, `email`) VALUES
(1, 'Felipe Matos', '123.456.789-12', '4444-4445', 'felipe2@gmail.com'),
(2, 'Gustavo Barbosa', '987.654.321-23', '5555-5556', 'gustavo2@gmail.com'),
(3, 'Wellison Ferreira', '456.789.123-34', '6666-6667', 'wellison2@gmail.com'),
(4, 'Joana Silva', '111.222.333-44', '7777-7777', 'joana@gmail.com'),
(5, 'Pedro Santos', '555.666.777-88', '8888-8888', 'pedro@gmail.com'),
(6, 'Ana Souza', '999.888.777-66', '9999-9999', 'ana@gmail.com'),
(7, 'Marcos Oliveira', '333.444.555-99', '0000-0000', 'marcos@gmail.com'),
(8, 'Carla Mendes', '777.888.999-11', '1111-1111', 'carla@gmail.com'),
(9, 'Lucas Fernandes', '222.333.444-55', '2222-2222', 'lucas@gmail.com'),
(10, 'Camila Costa', '666.777.888-22', '3333-3333', 'camila@gmail.com'),
(11, 'Roberto Almeida', '444.555.666-77', '4444-4444', 'roberto@gmail.com'),
(12, 'Amanda Silva', '888.999.111-00', '5555-5555', 'amanda@gmail.com'),
(13, 'Rodrigo Santos', '222.333.555-88', '6666-6666', 'rodrigo@gmail.com'),
(14, 'Renata Oliveira', '777.888.222-33', '7777-7877', 'renata@gmail.com'),
(15, 'Eduardo Costa', '333.444.666-99', '8888-8878', 'eduardo@gmail.com'),
(16, 'Sandra Lima', '555.666.888-11', '9999-9399', 'sandra@gmail.com'),
(17, 'Rafaela Souza', '111.222.444-66', '1234-5678', 'rafaela@gmail.com'),
(18, 'Bruno Martins', '999.888.777-22', '2345-6789', 'bruno@gmail.com'),
(19, 'Isabela Ferreira', '444.555.999-33', '3456-7890', 'isabela@gmail.com'),
(20, 'Paulo Rodrigues', '888.999.222-44', '4567-8901', 'paulo@gmail.com');

-- -----------------------------------------------------
-- Table `bd_abualugas`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_abualugas`.`clientes` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `cpf_cnpj` VARCHAR(20) NULL DEFAULT NULL,
  `endereco` VARCHAR(255) NULL DEFAULT NULL,
  `telefone` VARCHAR(20) NULL DEFAULT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `carteira_motorista` VARCHAR(20) NOT NULL,
  `validade_carteira` DATE NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE INDEX `cpf_cnpj` (`cpf_cnpj` ASC) VISIBLE
) ENGINE=InnoDB
AUTO_INCREMENT=21
DEFAULT CHARACTER SET=utf8mb4;

INSERT INTO `clientes` (`id_cliente`, `nome`, `cpf_cnpj`, `endereco`, `telefone`, `email`, `carteira_motorista`, `validade_carteira`) VALUES
(1, 'João Silva', '123.456.789-00', 'Rua A, 123', '1111-1111', 'joao@gmail.com', 'ABC123456', '2025-12-31'),
(2, 'Maria Oliveira', '987.654.321-00', 'Rua B, 456', '2222-2222', 'maria@gmail.com', 'DEF654321', '2024-06-30'),
(3, 'Pedro Santos', '456.789.123-00', 'Rua C, 789', '3333-3333', 'pedro@gmail.com', 'GHI789123', '2026-03-15'),
(4, 'Ana Souza', '111.222.333-44', 'Av. X, 789', '4444-4444', 'ana@gmail.com', 'JKL987654', '2025-08-15'),
(5, 'Carlos Ferreira', '222.333.444-55', 'Rua Y, 456', '5555-5555', 'carlos@gmail.com', 'MNO123456', '2024-11-30'),
(6, 'Mariana Costa', '333.444.555-66', 'Rua Z, 321', '6666-6666', 'mariana@gmail.com', 'PQR789012', '2026-05-20'),
(7, 'Rafaela Lima', '444.555.666-77', 'Av. W, 987', '7777-7777', 'rafaela@gmail.com', 'STU345678', '2023-09-10'),
(8, 'Rodrigo Vieira', '555.666.777-88', 'Rua K, 654', '8888-8888', 'rodrigo@gmail.com', 'VWX901234', '2024-07-25'),
(9, 'Camila Santos', '666.777.888-99', 'Av. M, 987', '9999-9999', 'camila@gmail.com', 'YZA567890', '2025-04-05'),
(10, 'Fernanda Oliveira', '777.888.999-00', 'Rua D, 321', '1010-1010', 'fernanda@gmail.com', 'BCD234567', '2023-11-15'),
(11, 'Gustavo Ferreira', '888.999.000-11', 'Av. E, 654', '1212-1212', 'gustavo@gmail.com', 'EFG345678', '2024-09-20'),
(12, 'Lucas Souza', '999.000.111-22', 'Rua F, 987', '1313-1313', 'lucas@gmail.com', 'HIJ456789', '2025-06-30'),
(13, 'Patrícia Lima', '000.111.222-33', 'Av. G, 456', '1414-1414', 'patricia@gmail.com', 'KLM567890', '2026-01-25'),
(14, 'Renato Costa', '111.222.333-55', 'Rua H, 654', '1515-1515', 'renato@gmail.com', 'NOP678901', '2023-07-10'),
(15, 'Sandra Vieira', '222.333.444-66', 'Av. I, 789', '1616-1616', 'sandra@gmail.com', 'QRS789012', '2024-04-15'),
(16, 'Thiago Santos', '333.444.555-77', 'Rua J, 123', '1717-1717', 'thiago@gmail.com', 'TUV890123', '2025-09-05'),
(17, 'Vanessa Oliveira', '444.555.666-88', 'Av. L, 987', '1818-1818', 'vanessa@gmail.com', 'WXY901234', '2026-02-20'),
(18, 'Roberto Silva', '555.666.777-99', 'Rua N, 321', '1919-1919', 'roberto@gmail.com', 'YZA012345', '2023-12-01'),
(19, 'Carolina Souza', '666.777.888-00', 'Av. O, 654', '2020-2020', 'carolina@gmail.com', 'BCD123456', '2024-10-10'),
(20, 'Lucas Pereira', '777.888.999-11', 'Rua P, 987', '2121-2121', 'lucas.pereira@gmail.com', 'CDE234567', '2025-07-15');

-- -----------------------------------------------------
-- Table `bd_abualugas`.`alugueis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_abualugas`.`alugueis` (
  `id_aluguel` INT NOT NULL AUTO_INCREMENT,
  `id_funcionario` INT NOT NULL,
  `data_inicio` DATE NULL DEFAULT NULL,
  `data_fim` DATE NULL DEFAULT NULL,
  `id_veiculo` INT NOT NULL,
  `id_cliente` INT NOT NULL,
  PRIMARY KEY (`id_aluguel`),
  INDEX `id_funcionario` (`id_funcionario` ASC) VISIBLE,
  INDEX `fk_alugueis_clientes1_idx` (`id_cliente` ASC) VISIBLE,
  CONSTRAINT `alugueis_ibfk_1`
    FOREIGN KEY (`id_funcionario`)
    REFERENCES `bd_abualugas`.`funcionarios` (`id_funcionario`),
  CONSTRAINT `fk_alugueis_clientes1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `bd_abualugas`.`clientes` (`id_cliente`)
) ENGINE=InnoDB
AUTO_INCREMENT=21
DEFAULT CHARACTER SET=utf8mb4;

INSERT INTO `alugueis` (`id_aluguel`, `id_funcionario`, `data_inicio`, `data_fim`, `valor_km`, `valor_total`, `id_cliente`) VALUES
(1, 1, '2023-01-01', '2023-01-15', 2.00, 300.00, 1),
(2, 2, '2023-02-01', '2023-02-15', 1.75, 250.00, 2),
(3, 3, '2023-03-01', '2023-03-15', 2.50, 400.00, 3),
(4, 4, '2023-04-01', '2023-04-15', 2.25, 350.00, 4),
(5, 5, '2023-05-01', '2023-05-15', 1.85, 280.00, 5),
(6, 6, '2023-06-01', '2023-06-15', 2.10, 320.00, 6),
(7, 7, '2023-07-01', '2023-07-15', 2.00, 300.00, 7),
(8, 8, '2023-08-01', '2023-08-15', 1.90, 290.00, 8),
(9, 9, '2023-09-01', '2023-09-15', 2.30, 340.00, 9),
(10, 10, '2023-10-01', '2023-10-15', 2.40, 360.00, 10),
(11, 11, '2023-11-01', '2023-11-15', 2.20, 330.00, 11),
(12, 12, '2023-12-01', '2023-12-15', 1.95, 290.00, 12),
(13, 13, '2024-01-01', '2024-01-15', 2.15, 310.00, 13),
(14, 14, '2024-02-01', '2024-02-15', 2.35, 350.00, 14),
(15, 15, '2024-03-01', '2024-03-15', 2.00, 300.00, 15),
(16, 16, '2024-04-01', '2024-04-15', 1.80, 270.00, 16),
(17, 17, '2024-05-01', '2024-05-15', 2.25, 330.00, 17),
(18, 18, '2024-06-01', '2024-06-15', 2.40, 350.00, 18),
(19, 19, '2024-07-01', '2024-07-15', 2.10, 320.00, 19),
(20, 20, '2024-08-01', '2024-08-15', 2.75, 250.00, 20);

-- -----------------------------------------------------
-- Table `bd_abualugas`.`pagamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_abualugas`.`pagamentos` (
  `id_pagamento` INT NOT NULL AUTO_INCREMENT,
  `id_aluguel` INT NOT NULL,
  `data_pagamento` DATE NULL DEFAULT NULL,
  `valor_km` DECIMAL(10,2) NULL DEFAULT NULL,
  `valor_total` DECIMAL(10,2) NULL DEFAULT NULL,
  `valor_pagamento` DECIMAL(10,2) NULL DEFAULT NULL,
  `metodo_pagamento` ENUM('Dinheiro', 'Cartao', 'Pix', 'Outro') NULL DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  INDEX `id_aluguel` (`id_aluguel` ASC) VISIBLE,
  CONSTRAINT `pagamentos_ibfk_1`
    FOREIGN KEY (`id_aluguel`)
    REFERENCES `bd_abualugas`.`alugueis` (`id_aluguel`)
) ENGINE=InnoDB
AUTO_INCREMENT=21
DEFAULT CHARACTER SET=utf8mb4;

INSERT INTO `pagamentos` (`id_pagamento`, `id_aluguel`, `data_pagamento`, `valor_pagamento`, `metodo_pagamento`) VALUES
(1, 1, '2023-01-10', 100.00, 'Cartao'),
(2, 2, '2023-02-10', 120.00, 'Pix'),
(3, 3, '2023-03-10', 150.00, 'Dinheiro'),
(4, 4, '2023-04-10', 175.00, 'Cartao'),
(5, 5, '2023-05-10', 130.00, 'Pix'),
(6, 6, '2023-06-10', 160.00, 'Dinheiro'),
(7, 7, '2023-07-10', 140.00, 'Cartao'),
(8, 8, '2023-08-10', 145.00, 'Pix'),
(9, 9, '2023-09-10', 155.00, 'Dinheiro'),
(10, 10, '2023-10-10', 165.00, 'Cartao'),
(11, 11, '2023-11-10', 135.00, 'Pix'),
(12, 12, '2023-12-10', 140.00, 'Dinheiro'),
(13, 13, '2024-01-10', 155.00, 'Cartao'),
(14, 14, '2024-02-10', 160.00, 'Pix'),
(15, 15, '2024-03-10', 145.00, 'Dinheiro'),
(16, 16, '2024-04-10', 150.00, 'Cartao'),
(17, 17, '2024-05-10', 165.00, 'Pix'),
(18, 18, '2024-06-10', 170.00, 'Dinheiro'),
(19, 19, '2024-07-10', 175.00, 'Cartao'),
(20, 20, '2024-08-10', 55.00, 'Pix');

-- -----------------------------------------------------
-- Table `bd_abualugas`.`veiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_abualugas`.`veiculos` (
  `id_veiculo` INT NOT NULL AUTO_INCREMENT,
  `modelo` VARCHAR(100) NOT NULL,
  `marca` VARCHAR(100) NOT NULL,
  `ano` INT NOT NULL,
  `placa` VARCHAR(10) NOT NULL,
  `cor` VARCHAR(20) NOT NULL,
  `km_atual` INT NOT NULL,
  `tipo` ENUM('Carro', 'Moto') NOT NULL,
  `airbag` TINYINT(1) NOT NULL,
  `num_bancos` INT NOT NULL,
  `num_portas` INT NOT NULL,
  `combustivel` ENUM('Gasolina', 'Etanol', 'Diesel', 'Flex', 'Eletrico', 'Hibrido') NOT NULL,
  `cambio` ENUM('Manual', 'Automatico', 'CVT', 'DCT') NOT NULL,
  `ar_condicionado` TINYINT(1) NOT NULL,
  `direcao` ENUM('Mecanica', 'Hidraulica', 'Eletrica') NOT NULL,
  `som` TINYINT(1) NOT NULL,
  `bluetooth` TINYINT(1) NOT NULL,
  `gps` TINYINT(1) NOT NULL,
  `sensor_estacionamento` TINYINT(1) NOT NULL,
  `camera_re` TINYINT(1) NOT NULL,
  `disponivel` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_veiculo`),
  UNIQUE INDEX `placa` (`placa` ASC) VISIBLE
) ENGINE=InnoDB
AUTO_INCREMENT=21
DEFAULT CHARACTER SET=utf8mb4;

INSERT INTO `veiculos` (`id_veiculo`, `modelo`, `marca`, `ano`, `placa`, `cor`, `km_atual`, `tipo`, `airbag`, `num_bancos`, `num_portas`, `combustivel`, `cambio`, `ar_condicionado`, `direcao`, `som`, `bluetooth`, `gps`, `sensor_estacionamento`, `camera_re`, `disponivel`) VALUES
(1, 'Fusca', 'Volkswagen', 1985, 'ABC1D23', 'Azul', 150000, 'Carro', 1, 2, 2, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(2, 'Civic', 'Honda', 2022, 'XYZ9W78', 'Preto', 5000, 'Carro', 6, 5, 4, 'Flex', 'Automatico', 1, 'Hidraulica', 1, 1, 1, 1, 1, 1),
(3, 'Onix', 'Chevrolet', 2020, 'FGH4J56', 'Branco', 20000, 'Carro', 6, 5, 4, 'Flex', 'Automatico', 1, 'Hidraulica', 1, 1, 1, 1, 1, 1),
(4, 'Hilux', 'Toyota', 2018, 'JKL7N89', 'Cinza', 40000, 'Carro', 6, 5, 4, 'Diesel', 'Automatico', 1, 'Hidraulica', 1, 1, 1, 1, 1, 1),
(5, 'F-150', 'Ford', 2019, 'MNO5P67', 'Preto', 30000, 'Carro', 6, 5, 4, 'Flex', 'Automatico', 1, 'Hidraulica', 1, 1, 1, 1, 1, 1),
(6, 'CB 500', 'Honda', 2021, 'RUV3W56', 'Vermelha', 5000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(7, 'R1', 'Yamaha', 2020, 'SDF4E67', 'Azul', 8000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(8, 'Glide', 'Harley-Davidson', 2022, 'HGD5F67', 'Preto', 3000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(9, 'Titan', 'Honda', 2023, 'TIT1N23', 'Cinza', 1000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(10, 'Tenere', 'Yamaha', 2023, 'TEN3R23', 'Preto', 2000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(11, 'Camaro', 'Chevrolet', 2021, 'CAR9O01', 'Amarelo', 10000, 'Carro', 6, 5, 2, 'Flex', 'Automatico', 1, 'Hidraulica', 1, 1, 1, 1, 1, 1),
(12, 'Ranger', 'Ford', 2019, 'RNG2T34', 'Branco', 25000, 'Carro', 6, 5, 4, 'Diesel', 'Automatico', 1, 'Hidraulica', 1, 1, 1, 1, 1, 1),
(13, 'Palio', 'Fiat', 2017, 'PAL4I56', 'Vermelho', 60000, 'Carro', 6, 5, 4, 'Flex', 'Manual', 1, 'Mecanica', 1, 0, 0, 0, 0, 1),
(14, 'Kawasaki Ninja', 'Kawasaki', 2022, 'KAW9N34', 'Verde', 4000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(15, 'Land Cruiser', 'Toyota', 2020, 'LAN4C67', 'Preto', 20000, 'Carro', 6, 5, 4, 'Diesel', 'Automatico', 1, 'Hidraulica', 1, 1, 1, 1, 1, 1),
(16, 'Z900', 'Kawasaki', 2019, 'Z900K19', 'Preto', 12000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(17, 'Gol', 'Volkswagen', 2018, 'GOL8F56', 'Cinza', 50000, 'Carro', 6, 5, 4, 'Flex', 'Manual', 1, 'Hidraulica', 1, 0, 0, 0, 0, 1),
(18, 'CBR 1000RR', 'Honda', 2023, 'CBR1R23', 'Vermelho', 1500, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(19, 'Fusca', 'Volkswagen', 1985, 'FUS5C56', 'Amarelo', 150000, 'Carro', 1, 2, 2, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1),
(20, 'Ninja ZX-6R', 'Kawasaki', 2021, 'NIN6Z21', 'Azul', 8000, 'Moto', 2, 2, 0, 'Gasolina', 'Manual', 0, 'Mecanica', 0, 0, 0, 0, 0, 1);

