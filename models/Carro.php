<?php

class Carro {
    private $pdo;

    public function __construct() {
        require_once 'config/database.php';
        $this->pdo = Database::getInstance()->getPDO();
    }

    // Listar carros com filtros
    public function inserirCarro($values = array()) {

        if ($values["destaque"] != 0) {
            $sql = "UPDATE carros SET destaque = 0 WHERE loja_id = :loja_id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array("loja_id" => $values["loja_id"]));
        }

        $sql = "INSERT INTO carros (
            id, nome, preco,
            ano, descricao, imagens,
            destaque, loja_id
            ) VALUES (
            :id, :modelo, :preco, :ano,
            :descricao, :imagens,
            :destaque, :loja_id
            );";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            return '';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public function deletarTodosCarros($id = '') {
        $sql = "DELETE FROM carros WHERE loja_id = :loja_id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue("loja_id", $id);
            $stmt->execute();
            $_SESSION['tipo'] = 'success';
            $_SESSION['mensagem'] = 'Carros deletados com sucesso';

        } catch (PDOException $e) {
            $_SESSION['tipo'] = 'danger';
            $_SESSION['mensagem'] = 'Erro ao tentar deletar os carros: ' . $e->getMessage();


        }
    }

    public function getCarro($id = '') {
        $sql = "SELECT c.id, c.nome, c.preco, c.ano, c.descricao, c.imagens, c.destaque, c.loja_id, l.nome AS nome_loja
                  FROM carros c
                  JOIN lojas l ON l.id = c.loja_id
                 WHERE c.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function destacarCarro($id = '') {

        try {
            $sql = "SELECT loja_id FROM carros WHERE id = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array("id" => $id));
            $loja_id = $stmt->fetch(PDO::FETCH_OBJ);
            
            $sql = "UPDATE carros SET destaque=0 WHERE loja_id = :loja_id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array("loja_id" => $loja_id->loja_id));
            
            $sql = "UPDATE carros SET destaque=1 WHERE id = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array("id" => $id));
            $_SESSION['tipo'] = 'success';
            $_SESSION['mensagem'] = 'Carro destacado com sucesso!';
        } catch (PDOException $e) {
            $_SESSION['tipo'] = 'danger';
            $_SESSION['mensagem'] = 'Erro ao destacar o carro:<br>' . $e->getMessage();
        }
    }

    public function listarCarros($ano = '', $loja = '', $cidade = '') {

        $sql = "SELECT c.id, c.nome, c.preco, c.ano, c.descricao, c.imagens, c.destaque, c.loja_id, l.nome AS nome_loja, l.cidade as cidade
                  FROM carros c
                  JOIN lojas l ON l.id = c.loja_id
                 WHERE 1=1";

        // Adiciona filtros dinamicamente
        if ($ano || $loja || $cidade){
            if ($ano) {
                $sql .= " AND c.ano = :ano";
            }
            if ($loja) {
                $sql .= " AND (l.nome = :loja_id OR l.id = :loja_id)";
            }
            if ($cidade) {
                $sql .= " AND l.cidade = :cidade";
            }
        } else {
            $sql .= " AND c.destaque = 1;";
        }

        $sql .= " ORDER BY c.created_at DESC;";


        try {
            $stmt = $this->pdo->prepare($sql);

            // Bind dos parâmetros
            if ($ano) {
                $stmt->bindValue(':ano', $ano);
            }
            if ($loja) {
                $stmt->bindValue(':loja_id', $loja);
            }
            if ($cidade) {
                $stmt->bindValue(':cidade', $cidade);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorno seguro e legível
        } catch (PDOException $e) {
            // Tratar erros de forma apropriada
            echo "Erro: " . $e->getMessage();
            return array(); // Retorna array vazio em caso de erro
        }
    }

    public function deletarCarro($id) {

        $sql = "SELECT imagens FROM carros WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $imagens = $stmt->fetch(PDO::FETCH_OBJ);
        
        foreach(explode(',',$imagens->imagens) as $imagem) {
            unlink($imagem);
        }

        $sql = "DELETE FROM carros WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $_SESSION['tipo'] = 'success';
            $_SESSION['mensagem'] = 'Carro deletado com sucesso!';
        } catch (PDOException $e) {
            $_SESSION['tipo'] = 'danger';
            $_SESSION['mensagem'] = 'Erro ao deletar o carro:<br>' . $e->getMessage();
        }
    }
}

?>
