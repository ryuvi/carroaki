<?php

class Loja {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Criar uma nova loja
    public function criar($nome, $cliente_id) {
        $sql = "INSERT INTO lojas (nome, cliente_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $cliente_id]);
        return $this->pdo->lastInsertId();
    }

    // Obter loja por ID
    public function obterPorId($id) {
        $sql = "SELECT * FROM lojas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obter todos os carros da loja
    public function obterCarrosDaLoja($loja_id) {
        $sql = "SELECT * FROM carros WHERE loja_id = ? ORDER BY data_publicacao DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$loja_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
