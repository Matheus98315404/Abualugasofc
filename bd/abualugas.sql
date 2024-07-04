CREATE DATABASE bd_abualugas;
USE bd_abualugas;

CREATE TABLE Clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    cpf_cnpj VARCHAR(20) UNIQUE,
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    email VARCHAR(100),
    carteira_motorista VARCHAR(20) NOT NULL,
    validade_carteira DATE NOT NULL
);

CREATE TABLE Veiculos (
    id_veiculo INT PRIMARY KEY AUTO_INCREMENT,
    modelo VARCHAR(100),
    marca VARCHAR(100),
    ano INT,
    placa VARCHAR(10) UNIQUE,
    cor VARCHAR(20),
    km_atual INT,
    tipo ENUM('Carro', 'Moto'),
    airbag BOOLEAN,
    num_bancos INT,
    num_portas INT,
    combustivel ENUM('Gasolina', 'Etanol', 'Diesel', 'Flex', 'Eletrico', 'Hibrido'),
    cambio ENUM('Manual', 'Automatico', 'CVT', 'DCT'),
    ar_condicionado BOOLEAN,
    direcao ENUM('Mecanica', 'Hidraulica', 'Eletrica'),
    som BOOLEAN,
    bluetooth BOOLEAN,
    gps BOOLEAN,
    sensor_estacionamento BOOLEAN,
    camera_re BOOLEAN,
    disponivel BOOLEAN DEFAULT TRUE
);

CREATE TABLE Funcionarios (
    id_funcionario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    cpf VARCHAR(20) UNIQUE,
    telefone VARCHAR(20),
    email VARCHAR(100),
);

CREATE TABLE Alugueis (
    id_aluguel INT PRIMARY KEY AUTO_INCREMENT,
    id_veiculo INT,
    id_funcionario INT,
    data_inicio DATE,
    data_fim DATE,
    km_inicial INT,
    km_final INT,
    valor_km DECIMAL(10, 2),
    valor_total DECIMAL(10, 2),
    pagamento VARCHAR(20),
    FOREIGN KEY (id_veiculo) REFERENCES Veiculos(id_veiculo),
    FOREIGN KEY (id_funcionario) REFERENCES Funcionarios(id_funcionario)
);

CREATE TABLE ClienteAlugueis (
    id_cliente INT,
    id_aluguel INT,
    PRIMARY KEY (id_cliente, id_aluguel),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente),
    FOREIGN KEY (id_aluguel) REFERENCES Alugueis(id_aluguel)
);

CREATE TABLE Pagamentos (
    id_pagamento INT PRIMARY KEY AUTO_INCREMENT,
    id_aluguel INT,
    data_pagamento DATE,
    valor_pagamento DECIMAL(10, 2),
    metodo_pagamento ENUM('Dinheiro', 'Cartao', 'Pix', 'Outro'),
    FOREIGN KEY (id_aluguel) REFERENCES Alugueis(id_aluguel)
);

INSERT INTO Clientes (nome, cpf_cnpj, endereco, telefone, email, carteira_motorista, validade_carteira)
VALUES 
('João Silva', '123.456.789-00', 'Rua A, 123', '1111-1111', 'joao@gmail.com', 'ABC123456', '2025-12-31'),
('Maria Oliveira', '987.654.321-00', 'Rua B, 456', '2222-2222', 'maria@gmail.com', 'DEF654321', '2024-06-30'),
('Pedro Santos', '456.789.123-00', 'Rua C, 789', '3333-3333', 'pedro@gmail.com', 'GHI789123', '2026-03-15'),
('Ana Souza', '111.222.333-44', 'Av. X, 789', '4444-4444', 'ana@gmail.com', 'JKL987654', '2025-08-15'),
('Carlos Ferreira', '222.333.444-55', 'Rua Y, 456', '5555-5555', 'carlos@gmail.com', 'MNO123456', '2024-11-30'),
('Mariana Costa', '333.444.555-66', 'Rua Z, 321', '6666-6666', 'mariana@gmail.com', 'PQR789012', '2026-05-20'),
('Rafaela Lima', '444.555.666-77', 'Av. W, 987', '7777-7777', 'rafaela@gmail.com', 'STU345678', '2023-09-10'),
('Rodrigo Vieira', '555.666.777-88', 'Rua K, 654', '8888-8888', 'rodrigo@gmail.com', 'VWX901234', '2024-07-25'),
('Camila Santos', '666.777.888-99', 'Av. M, 987', '9999-9999', 'camila@gmail.com', 'YZA567890', '2025-04-05'),
('Fernanda Oliveira', '777.888.999-00', 'Rua D, 321', '1010-1010', 'fernanda@gmail.com', 'BCD234567', '2023-11-15'),
('Gustavo Ferreira', '888.999.000-11', 'Av. E, 654', '1212-1212', 'gustavo@gmail.com', 'EFG345678', '2024-09-20'),
('Lucas Souza', '999.000.111-22', 'Rua F, 987', '1313-1313', 'lucas@gmail.com', 'HIJ456789', '2025-06-30'),
('Patrícia Lima', '000.111.222-33', 'Av. G, 456', '1414-1414', 'patricia@gmail.com', 'KLM567890', '2026-01-25'),
('Renato Costa', '111.222.333-55', 'Rua H, 654', '1515-1515', 'renato@gmail.com', 'NOP678901', '2023-07-10'),
('Sandra Vieira', '222.333.444-66', 'Av. I, 789', '1616-1616', 'sandra@gmail.com', 'QRS789012', '2024-04-15'),
('Thiago Santos', '333.444.555-77', 'Rua J, 123', '1717-1717', 'thiago@gmail.com', 'TUV890123', '2025-09-05'),
('Vanessa Oliveira', '444.555.666-88', 'Av. L, 987', '1818-1818', 'vanessa@gmail.com', 'WXY901234', '2026-02-20'),
('Roberto Silva', '555.666.777-99', 'Rua N, 321', '1919-1919', 'roberto@gmail.com', 'YZA012345', '2023-12-01'),
('Carolina Souza', '666.777.888-00', 'Av. O, 654', '2020-2020', 'carolina@gmail.com', 'BCD123456', '2024-10-10'),
('Lucas Pereira', '777.888.999-11', 'Rua P, 987', '2121-2121', 'lucas.pereira@gmail.com', 'EFG234567', '2025-07-15');

INSERT INTO Veiculos (modelo, marca, ano, placa, cor, km_atual, tipo, airbag, num_bancos, num_portas, combustivel, cambio, ar_condicionado, direcao, som, bluetooth, gps, sensor_estacionamento, camera_re, disponivel)
VALUES 
('Civic', 'Honda', 2020, 'ABC-1234', 'Preto', 50000, 'Carro', TRUE, 5, 4, 'Gasolina', 'Automatico', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Corolla', 'Toyota', 2021, 'DEF-5678', 'Branco', 30000, 'Carro', TRUE, 5, 4, 'Flex', 'CVT', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Ninja', 'Kawasaki', 2019, 'GHI-9101', 'Verde', 10000, 'Moto', FALSE, 2, 0, 'Gasolina', 'Manual', FALSE, 'Mecanica', TRUE, TRUE, FALSE, FALSE, FALSE, TRUE),
('Gol', 'Volkswagen', 2018, 'JKL-2345', 'Prata', 40000, 'Carro', FALSE, 5, 4, 'Flex', 'Manual', FALSE, 'Mecanica', FALSE, FALSE, FALSE, FALSE, FALSE, TRUE),
('Fiesta', 'Ford', 2019, 'MNO-6789', 'Azul', 35000, 'Carro', TRUE, 5, 4, 'Flex', 'Automatico', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('CBR 600', 'Honda', 2020, 'PQR-1234', 'Vermelho', 15000, 'Moto', FALSE, 1, 0, 'Gasolina', 'Manual', FALSE, 'Mecanica', FALSE, FALSE, FALSE, FALSE, FALSE, TRUE),
('Fusion', 'Ford', 2022, 'STU-5678', 'Cinza', 25000, 'Carro', TRUE, 5, 4, 'Hibrido', 'CVT', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('S10', 'Chevrolet', 2021, 'VWX-9101', 'Prata', 20000, 'Carro', TRUE, 5, 4, 'Diesel', 'Automatico', TRUE, 'Hidraulica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Uno', 'Fiat', 2017, 'YZA-2345', 'Verde', 45000, 'Carro', FALSE, 5, 2, 'Flex', 'Manual', FALSE, 'Mecanica', FALSE, FALSE, FALSE, FALSE, FALSE, TRUE),
('HR-V', 'Honda', 2023, 'BCD-6789', 'Prata', 10000, 'Carro', TRUE, 5, 4, 'Flex', 'CVT', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Golf', 'Volkswagen', 2020, 'EFG-1234', 'Preto', 28000, 'Carro', TRUE, 5, 4, 'Flex', 'Automatico', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('XRE 300', 'Honda', 2021, 'HIJ-5678', 'Vermelho', 18000, 'Moto', FALSE, 1, 0, 'Gasolina', 'Manual', FALSE, 'Mecanica', FALSE, FALSE, FALSE, FALSE, FALSE, TRUE),
('EcoSport', 'Ford', 2018, 'KLM-9101', 'Preto', 32000, 'Carro', TRUE, 5, 4, 'Flex', 'Automatico', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Toro', 'Fiat', 2022, 'NOP-2345', 'Cinza', 15000, 'Carro', TRUE, 5, 4, 'Diesel', 'Automatico', TRUE, 'Hidraulica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Tracker', 'Chevrolet', 2020, 'QRS-6789', 'Branco', 26000, 'Carro', TRUE, 5, 4, 'Flex', 'CVT', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('MT-07', 'Yamaha', 2021, 'TUV-1234', 'Azul', 12000, 'Moto', FALSE, 2, 0, 'Gasolina', 'Manual', FALSE, 'Mecanica', TRUE, TRUE, FALSE, FALSE, FALSE, TRUE),
('Compass', 'Jeep', 2023, 'WXY-5678', 'Prata', 8000, 'Carro', TRUE, 5, 4, 'Flex', 'Automatico', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Glide', 'Harley-Davidson', 2020, 'YZA-9101', 'Preto', 15000, 'Moto', TRUE, 2, 0, 'Gasolina', 'Manual', FALSE, 'Mecanica', TRUE, TRUE, FALSE, FALSE, FALSE, TRUE),
('Onix', 'Chevrolet', 2021, 'BCD-2345', 'Vermelho', 18000, 'Carro', TRUE, 5, 4, 'Flex', 'CVT', TRUE, 'Eletrica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('Ranger', 'Ford', 2022, 'EFG-6789', 'Branco', 12000, 'Carro', TRUE, 5, 4, 'Diesel', 'Automatico', TRUE, 'Hidraulica', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
('CB 1000R', 'Honda', 2019, 'HIJ-1234', 'Preto', 22000, 'Moto', FALSE, 1, 0, 'Gasolina', 'Manual', FALSE, 'Mecanica', FALSE, FALSE, FALSE, FALSE, FALSE, TRUE);

INSERT INTO Funcionarios (nome, cpf, telefone, email,)
VALUES 
('Felipe Matos', '123.456.789-12', '4444-4445', 'felipe2@gmail.com'),
('Gustavo Barbosa', '987.654.321-23', '5555-5556', 'gustavo2@gmail.com'),
('Wellison Ferreira', '456.789.123-34', '6666-6667', 'wellison2@gmail.com'),
('Joana Silva', '111.222.333-44', '7777-7777', 'joana@gmail.com'),
('Pedro Santos', '555.666.777-88', '8888-8888', 'pedro@gmail.com'),
('Ana Souza', '999.888.777-66', '9999-9999', 'ana@gmail.com'),
('Marcos Oliveira', '333.444.555-99', '0000-0000', 'marcos@gmail.com'),
('Carla Mendes', '777.888.999-11', '1111-1111', 'carla@gmail.com'),
('Lucas Fernandes', '222.333.444-55', '2222-2222', 'lucas@gmail.com'),
('Camila Costa', '666.777.888-22', '3333-3333', 'camila@gmail.com'),
('Roberto Almeida', '444.555.666-77', '4444-4444', 'roberto@gmail.com'),
('Amanda Silva', '888.999.111-00', '5555-5555', 'amanda@gmail.com'),
('Rodrigo Santos', '222.333.555-88', '6666-6666', 'rodrigo@gmail.com'),
('Renata Oliveira', '777.888.222-33', '7777-7777', 'renata@gmail.com'),
('Eduardo Costa', '333.444.666-99', '8888-8888', 'eduardo@gmail.com'),
('Sandra Lima', '555.666.888-11', '9999-9999', 'sandra@gmail.com'),
('Rafaela Souza', '111.222.444-66', '1234-5678', 'rafaela@gmail.com'),
('Bruno Martins', '999.888.777-22', '2345-6789', 'bruno@gmail.com'),
('Isabela Ferreira', '444.555.999-33', '3456-7890', 'isabela@gmail.com'),
('Paulo Rodrigues', '888.999.222-44', '4567-8901', 'paulo@gmail.com');

INSERT INTO Alugueis (id_veiculo, id_funcionario, data_inicio, data_fim, km_inicial, km_final, valor_km, valor_total, pagamento)
VALUES 
(1, 1, '2023-01-01', '2023-01-10', 50000, 50500, 2.00, 100.00, TRUE),
(2, 2, '2023-02-01', '2023-02-05', 30000, 30200, 2.50, 50.00, TRUE),
(3, 3, '2023-03-01', '2023-03-03', 10000, 10050, 3.00, 15.00, TRUE),
(4, 4, '2023-04-01', '2023-04-05', 40000, 40200, 2.75, 55.00, TRUE),
(5, 5, '2023-05-01', '2023-05-10', 25000, 25500, 2.25, 112.50, TRUE),
(6, 6, '2023-06-01', '2023-06-03', 18000, 18200, 3.10, 31.00, TRUE),
(7, 7, '2023-07-01', '2023-07-15', 35000, 35700, 2.90, 203.00, TRUE),
(8, 8, '2023-08-01', '2023-08-08', 29000, 29300, 2.40, 72.00, TRUE),
(9, 9, '2023-09-01', '2023-09-20', 42000, 42500, 2.80, 140.00, TRUE),
(10, 10,'2023-10-01', '2023-10-05', 31000, 31200, 2.60, 52.00, TRUE),
(11, 11, '2023-11-01', '2023-11-25', 38000, 38500, 2.70, 270.00, TRUE),
(12, 12, '2023-12-01', '2023-12-12', 27000, 27300, 2.35, 70.50, TRUE),
(13, 13, '2024-01-01', '2024-01-07', 32000, 32400, 2.45, 49.00, TRUE),
(14, 14, '2024-02-01', '2024-02-03', 19000, 19100, 3.20, 32.00, TRUE),
(15, 15, '2024-03-01', '2024-03-09', 40000, 40500, 2.85, 142.50, TRUE),
(16, 16, '2024-04-01', '2024-04-14', 26000, 26500, 2.55, 153.00, TRUE),
(17, 17, '2024-05-01', '2024-05-05', 35000, 35200, 2.95, 59.00, TRUE),
(18, 18, '2024-06-01', '2024-06-18', 30000, 30500, 2.30, 115.00, TRUE),
(19, 19, '2024-07-01', '2024-07-04', 37000, 37150, 2.65, 39.75, TRUE),
(20, 20, '2024-08-01', '2024-08-10', 28000, 28200, 2.75, 55.00, TRUE);

INSERT INTO Pagamentos (id_aluguel, data_pagamento, valor_pagamento, metodo_pagamento)
VALUES 
(1, '2023-01-10', 100.00, 'Cartao'),
(2, '2023-02-05', 50.00, 'Dinheiro'),
(3, '2023-03-03', 15.00, 'Pix'),
(4, '2023-04-05', 55.00, 'Pix'),
(5, '2023-05-10', 112.50, 'Cartao'),
(6, '2023-06-03', 31.00, 'Dinheiro'),
(7, '2023-07-15', 203.00, 'Pix'),
(8, '2023-08-08', 72.00, 'Cartao'),
(9, '2023-09-20', 140.00, 'Cartao'),
(10, '2023-10-05', 52.00, 'Dinheiro'),
(11, '2023-11-25', 270.00, 'Pix'),
(12, '2023-12-12', 70.50, 'Pix'),
(13, '2024-01-07', 49.00, 'Cartao'),
(14, '2024-02-03', 32.00, 'Dinheiro'),
(15, '2024-03-09', 142.50, 'Pix'),
(16, '2024-04-14', 153.00, 'Pix'),
(17, '2024-05-05', 59.00, 'Cartao'),
(18, '2024-06-18', 115.00, 'Dinheiro'),
(19, '2024-07-04', 39.75, 'Pix'),
(20, '2024-08-10', 55.00, 'Pix');


