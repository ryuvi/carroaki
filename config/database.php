<?php

class Database {
    // Instância estática da classe (Singleton)
    private static $instance = null;
    private $pdo;

    // Construtor privado para evitar instância fora da classe
    private function __construct() {
        $dsn = 'sqlite:src/database.sqlite'; // Nome do banco de dados

        try {
            // Criando a conexão PDO
            $this->pdo = new PDO($dsn);
            // Definindo modo de erro
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            // Criar as tabelas, se não existirem
            $this->createTables();

        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    // Método para acessar a instância única da classe
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database(); // Cria a instância se não existir
        }

        return self::$instance; // Retorna a instância única
    }

    // Método para obter a instância do PDO
    public function getPDO() {
        return $this->pdo;
    }

    // Método para criar as tabelas no banco de dados
    private function createTables() {
        // Criação da tabela "lojas"
        $sql = "CREATE TABLE IF NOT EXISTS lojas (
            id TEXT PRIMARY KEY,
            nome TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            senha TEXT NOT NULL,
            cidade TEXT NOT NULL,
            banner TEXT,
            informacoes TEXT NOT NULL,
            ativo BOOLEAN DEFAULT 1, -- Para bloquear/desbloquear lojas
            role TEXT NOT NULL DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $this->pdo->exec($sql);

        // Criação da tabela "carros"
        $sql = "CREATE TABLE IF NOT EXISTS carros (
            id TEXT PRIMARY KEY,
            nome TEXT NOT NULL,
            preco REAL NOT NULL,
            ano INTEGER NOT NULL,
            descricao TEXT NOT NULL,
            imagens TEXT, -- Caminho das imagens (separadas por vírgula)
            destaque BOOLEAN DEFAULT 0, -- Para destacar carros
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            loja_id TEXT NOT NULL,
            FOREIGN KEY (loja_id) REFERENCES lojas(id)
        );";
        $this->pdo->exec($sql);

        // Criação da tabela "sponsors"
        $sql = "CREATE TABLE IF NOT EXISTS sponsors (
            id TEXT PRIMARY KEY,
            nome TEXT NOT NULL,
            link TEXT NOT NULL,
            imagem TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $this->pdo->exec($sql);
    }

    // Impede a clonagem da instância
    private function __clone() {}

    // Impede a desserialização da instância
    public function __wakeup() {}
}

// Usando o Singleton para obter a instância do banco de dados
// $db = Database::getInstance(); // Obtém a instância única
// $pdo = $db->getPDO(); // Obtém o objeto PDO para executar consultas

?>
