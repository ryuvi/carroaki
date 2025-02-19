<?php

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Criar um novo usuário
    public function criar($nome, $email, $senha, $tipo) {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_BCRYPT), $tipo]);
        return $this->pdo->lastInsertId();
    }

    // Obter usuário por ID
    public function obterPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar login
    public function verificarLogin($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }

    // Atualizar status de pagamento
    public function atualizarStatusPagamento($id, $status) {
        $sql = "UPDATE usuarios SET status_pagamento = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$status, $id]);
    }
}
?>
