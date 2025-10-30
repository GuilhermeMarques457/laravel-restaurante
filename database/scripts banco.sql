-- Criação do banco
CREATE DATABASE IF NOT EXISTS meurestaurante;
USE meurestaurante;

-- ======================
-- Tabela de usuários
-- ======================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ======================
-- Tabela de clientes
-- ======================
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ======================
-- Tabela de fornecedores
-- ======================
CREATE TABLE IF NOT EXISTS fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ======================
-- Tabela de ingredientes
-- ======================
CREATE TABLE IF NOT EXISTS ingredientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ======================
-- Tabela de pratos
-- ======================
CREATE TABLE IF NOT EXISTS pratos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ======================
-- Tabela de produtos
-- ======================
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ======================
-- Inserir dados iniciais (primeiro os pais)
-- ======================
INSERT INTO users (name, email, password) VALUES
('Admin', 'admin@meurestaurante.com', '$2y$10$e0NRqZ1ZX2eYpGz6iY8w0e3yUy8hT5yZ8o6FJ6l7V4KqT5JfXJb6a'); -- senha: 123456

INSERT INTO clientes (nome, endereco, telefone) VALUES
('João Silva', 'Rua A, 123', '11999999999'),
('Maria Souza', 'Rua B, 456', '11988888888');

INSERT INTO fornecedores (nome) VALUES
('Fornecedor 1'),
('Fornecedor 2');

INSERT INTO ingredientes (nome) VALUES
('Tomate'),
('Queijo'),
('Frango');

INSERT INTO pratos (nome, preco_unitario) VALUES
('Frango Assado', 25.50),
('Pizza de Queijo', 30.00);

INSERT INTO produtos (nome, preco) VALUES
('Refrigerante', 5.00),
('Suco Natural', 7.50);

-- ======================
-- Tabelas intermediárias / dependentes
-- ======================

-- ingrediente_prato
CREATE TABLE IF NOT EXISTS ingrediente_prato (
    prato_id INT NOT NULL,
    ingrediente_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    PRIMARY KEY (prato_id, ingrediente_id),
    FOREIGN KEY (prato_id) REFERENCES pratos(id) ON DELETE CASCADE,
    FOREIGN KEY (ingrediente_id) REFERENCES ingredientes(id) ON DELETE CASCADE
);

INSERT INTO ingrediente_prato (prato_id, ingrediente_id, quantidade) VALUES
(1, 3, 1), -- Frango Assado tem Frango
(2, 2, 1), -- Pizza de Queijo tem Queijo
(2, 1, 2); -- Pizza de Queijo tem Tomate

-- compras
CREATE TABLE IF NOT EXISTS compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nota_fiscal VARCHAR(50),
    data_compra DATE,
    quantidade INT,
    fornecedor_id INT,
    ingrediente_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id),
    FOREIGN KEY (ingrediente_id) REFERENCES ingredientes(id)
);

INSERT INTO compras (nota_fiscal, data_compra, quantidade, fornecedor_id, ingrediente_id) VALUES
('NF001', '2025-10-30', 10, 1, 1),
('NF002', '2025-10-30', 5, 2, 2);

-- encomendas
CREATE TABLE IF NOT EXISTS encomendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(50),
    cliente_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
);

INSERT INTO encomendas (numero, cliente_id) VALUES
('ENC001', 1),
('ENC002', 2);

-- encomenda_prato
CREATE TABLE IF NOT EXISTS encomenda_prato (
    encomenda_id INT NOT NULL,
    prato_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    PRIMARY KEY (encomenda_id, prato_id),
    FOREIGN KEY (encomenda_id) REFERENCES encomendas(id) ON DELETE CASCADE,
    FOREIGN KEY (prato_id) REFERENCES pratos(id) ON DELETE CASCADE
);

INSERT INTO encomenda_prato (encomenda_id, prato_id, quantidade) VALUES
(1, 1, 2),
(2, 2, 1);
