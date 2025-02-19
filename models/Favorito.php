<?php

class Favorito {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Marcar carro como favorito para destaque
    public function marcarDestaque($carro_id, $loja_id) {
        $sql = "INSERT INTO favoritos (carro_id, loja_id, destaque) VALUES (?, ?, 1)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$carro_id, $loja_id]);
    }

    // Remover destaque do carro
    public function removerDestaque($carro_id, $loja_id) {
        $sql = "DELETE FROM favoritos WHERE carro_id = ? AND loja_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$carro_id, $loja_id]);
    }

    // Obter carro em destaque da loja
    public function obterDestaqueDaLoja($loja_id) {
        $sql = "SELECT * FROM carros 
                WHERE id IN (SELECT carro_id FROM favoritos WHERE loja_id = ? AND destaque = 1)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$loja_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
