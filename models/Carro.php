<?php

class Carro {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Criar um novo carro
    public function criar($cliente_id, $marca, $modelo, $ano, $fotos, $descricao) {
        $sql = "INSERT INTO carros (cliente_id, marca, modelo, ano, fotos, descricao) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cliente_id, $marca, $modelo, $ano, $fotos, $descricao]);
        return $this->pdo->lastInsertId();
    }

    // Excluir um carro pelo ID
    public function excluirCarro($carro_id) {
        $stmt = $this->pdo->prepare("DELETE FROM carros WHERE id = ?");
        return $stmt->execute([$carro_id]);
    }


    // Obter todos os carros
    public function obterTodos() {
        $sql = "SELECT * FROM carros ORDER BY data_publicacao DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obter carro por ID
    public function obterPorId($id) {
        $sql = "SELECT * FROM carros WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obter carros por cliente
    public function obterPorCliente($cliente_id) {
        $sql = "SELECT * FROM carros WHERE cliente_id = ? ORDER BY data_publicacao DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualizar o status do carro
    public function atualizarStatus($id, $status) {
        $sql = "UPDATE carros SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$status, $id]);
    }
}
?>
