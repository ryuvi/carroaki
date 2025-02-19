<?php
// Configuração para usar SQLite
$dbFile = 'carros.db'; // Nome do banco de dados
try {
    // Criação ou abertura do banco SQLite
    $pdo = new PDO("sqlite:" . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Comandos SQL para criar as tabelas
    $sql = "
    CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL,
        tipo ENUM('admin', 'cliente') NOT NULL,
        status_pagamento ENUM('pago', 'pendente', 'bloqueado') NOT NULL DEFAULT 'pendente',
        data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS carros (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        cliente_id INTEGER NOT NULL,
        marca VARCHAR(255) NOT NULL,
        modelo VARCHAR(255) NOT NULL,
        ano INTEGER NOT NULL,
        fotos TEXT,
        descricao TEXT,
        status ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
        data_publicacao DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (cliente_id) REFERENCES usuarios(id)
    );

    CREATE TABLE IF NOT EXISTS lojas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome VARCHAR(255) NOT NULL,
        cliente_id INTEGER NOT NULL,
        FOREIGN KEY (cliente_id) REFERENCES usuarios(id)
    );

    CREATE TABLE IF NOT EXISTS favoritos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        carro_id INTEGER NOT NULL,
        loja_id INTEGER NOT NULL,
        destaque BOOLEAN NOT NULL DEFAULT 0,
        FOREIGN KEY (carro_id) REFERENCES carros(id),
        FOREIGN KEY (loja_id) REFERENCES lojas(id)
    );
    ";

    // Executando os comandos SQL para criar as tabelas
    $pdo->exec($sql);
    echo "Banco de dados e tabelas criadas com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar o banco de dados: " . $e->getMessage();
}
?>
