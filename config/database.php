<?php
$dsn = 'sqlite:src/database.sqlite'; // Nome do banco de dados
try {
    $pdo = new PDO($dsn);
    // Definindo erro simples, já que algumas versões do PHP podem não aceitar o modo de exceção diretamente.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // Criação da tabela de carros, se ela não existir
    $sql = "CREATE TABLE IF NOT EXISTS carros (
        id TEXT PRIMARY KEY,
        modelo TEXT NOT NULL,
        preco REAL NOT NULL,
        ano INTEGER NOT NULL,
        marca TEXT NOT NULL,
        contato TEXT NOT NULL,
        imagem TEXT NOT NULL,
        potencia TEXT,
        combustivel TEXT,
        cambio TEXT,
        quilometragem TEXT,
        loja_id TEXT,
        FOREIGN KEY (loja_id) REFERENCES lojas(id)
    )";
    $pdo->exec($sql);

    // Criação da tabela de lojas, se ela não exister
    $sql = "CREATE TABLE IF NOT EXISTS lojas (
        id TEXT PRIMARY KEY,
        nome TEXT NOT NULL,
        contato TEXT NOT NULL,
        email TEXT NOT NULL,
        usuario_id TEXT,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    )";

    // Criação da tabela de usuarios, se ela não existir
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id TEXT PRIMARY KEY,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        role TEXT NOT NULL
    )";
    $pdo->exec($sql);

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>