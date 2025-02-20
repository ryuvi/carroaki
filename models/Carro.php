<?php

class Carro {
    // Listar carros com filtros
    public function listarCarros($ano = '', $loja = '') {
        require __DIR__ . '/../config/database.php';

        $sql = "SELECT * FROM carros WHERE 1=1 ORDER BY created_at DESC";

        // Adiciona filtros dinamicamente
        if ($ano) {
            $sql .= " AND ano LIKE ?";
        }
        if ($loja) {
            $sql .= " AND loja LIKE ?";
        }

        try {
            $stmt = $pdo->prepare($sql);

            // Bind dos parâmetros
            $paramIndex = 1; // índice de parâmetro
            if ($ano) {
                $stmt->bindValue($paramIndex++, "%$ano%");
            }
            if ($loja) {
                $stmt->bindValue($paramIndex++, "%$loja%");
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorno seguro e legível
        } catch (PDOException $e) {
            // Tratar erros de forma apropriada
            echo "Erro: " . $e->getMessage();
            return array(); // Retorna array vazio em caso de erro
        }
    }
}

?>
