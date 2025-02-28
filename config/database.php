<?php
$dsn = 'sqlite:src/database.sqlite'; // Nome do banco de dados
try {
    $pdo = new PDO($dsn);
    // Definindo erro simples, já que algumas versões do PHP podem não aceitar o modo de exceção diretamente.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // Criação da tabela de usuarios, se ela não existir
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id TEXT PRIMARY KEY,
        name TEXT NOT NULL,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        email TEXT NOT NULL,
        role TEXT NOT NULL,
        status BOOLEAN DEFAULT 1, -- Para bloquear
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";
    $pdo->exec($sql);

    // Criação da tabela de carros, se ela não existir
    $sql = "CREATE TABLE IF NOT EXISTS lojas (
        id TEXT PRIMARY KEY,
        nome TEXT NOT NULL,
        banner TEXT,
        email TEXT NOT NULL UNIQUE,
        informacoes TEXT NOT NULL,
        ativo BOOLEAN DEFAULT 1, -- Para bloquear/desbloquear lojas
        -- FOREIGN KEYS
        usuario_id TEXT NOT NULL,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    );";
    $pdo->exec($sql);

    // Criação da tabela de lojas, se ela não exister
    $sql = "CREATE TABLE IF NOT EXISTS carros (
        id TEXT PRIMARY KEY,
        nome TEXT NOT NULL,
        preco REAL NOT NULL,
        ano INTEGER NOT NULL,
        descricao TEXT NOT NULL,
        imagens TEXT, -- Caminho das imagens (separadas por vírgula)
        destaque BOOLEAN DEFAULT 0, -- Para destacar carros
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        -- FOREIGN KEYS
        loja_id TEXT NOT NULL,
        FOREIGN KEY (loja_id) REFERENCES lojas(id)
    );";

    $sql = "-- Inserir usuário admin padrão
        INSERT OR IGNORE INTO usuarios (username, password, role)
        VALUES ('admin','semprelivre', 'admin'); -- Senha em texto plano (substitua por hash na prática)";
    $pdo->exec($sql);

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>