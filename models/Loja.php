<?php

class Loja {
    private function __constructor() {}

    public function verificarLoja($username = '', $senha = '') {
        require 'config/database.php';

        $sql = "SELECT * FROM lojas WHERE (nome = :nome OR email = :nome) AND senha = :senha";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue("nome", $username);
            $stmt->bindValue("senha", md5($senha));

            $stmt->execute();
            $loja = $stmt->fetch(PDO::FETCH_ASSOC);

            $login = !empty($loja) && $loja['ativo'] !== 0;

            return $login;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return array();
        }
    }

    public function getLojaId($username = '', $senha = '') {
        require 'config/database.php';
        $sql = "SELECT id FROM lojas WHERE nome = :nome AND senha = :senha";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue("nome", $username);
        $stmt->bindValue("senha", md5($senha));

        $stmt->execute();
        $loja = $stmt->fetch(PDO::FETCH_OBJ);
        return $loja->id;
    }

    public function getLoja($loja_id = '') {
        require 'config/database.php';
        $sql = "SELECT * FROM lojas WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue("id", $loja_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function listarLojas($user_id = '') {
        require 'config/database.php';
        $sql = "SELECT l.id, l.nome, l.email, l.informacoes, l.ativo
                  FROM lojas l";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bloquearLoja($id = '') {
        require 'config/database.php';
        $sql = "UPDATE lojas SET ativo = 0 WHERE id = :id;";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $_SESSION['tipo'] = 'success';
            $_SESSION['message'] = 'Loja bloqueada com sucesso.';
        } catch (PDOException $e) {
            $_SESSION['tipo'] = 'danger';
            $_SESSION['message'] = 'Não foi possível bloquear a loja.';
        }
    }

    public function desbloquearLoja($id = '') {
        require 'config/database.php';
        $sql = "UPDATE lojas SET ativo = 1 WHERE id = :id;";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $_SESSION['tipo'] = 'success';
            $_SESSION['message'] = 'Loja desbloqueada com sucesso.';
        } catch (PDOException $e) {
            $_SESSION['tipo'] = 'danger';
            $_SESSION['message'] = 'Não foi possível desbloquear a loja.';
        }
    }

    public function getLojaNome($id = '') {
        require 'config/database.php';
        $sql = "SELECT nome FROM lojas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $name = $stmt->fetch(PDO::FETCH_OBJ);
        return $name->nome;
    }

    public function criarLoja($values = array()) {
        require 'config/database.php';
        $sql = "INSERT INTO lojas (
                    id, nome, email, senha,
                    banner, informacoes
                ) VALUES (
                    :id, :nome, :email,
                    :password, :banner, :descricao
                )";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);
            return '';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public function deletarLoja($id = '') {
        require 'config/database.php';
        $sql = "DELETE FROM lojas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array("id" => $id));
    }
}

?>