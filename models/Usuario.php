<?php

class Usuario {
    public function verificarUsuario($usuario = '', $senha = '') {
        require 'config/database.php';

        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";

        try {
            $stmt = $pdo->prepare($sql);

            $senha_convertida = md5($senha);
            $stmt->bindValue(1, "$usuario");
            $stmt->bindValue(2, "$senha_convertida");

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return array();
        }
    }

    public function cadastrarUsuario($usuario = '', $senha = '') {
        require 'config/database.php';
        require 'src/utils.php';

        $sql = "INSERT INTO usuarios VALUES (?, ?, ?, 'user')";

        try {
            $stmt = $pdo->prepare($sql);
            $util = new Utility();
            $uuid = $util->gerarUUID();

            $senha_convertida = md5($senha);
            $stmt->bindValue(1, "$uuid");
            $stmt->bindValue(2, "$usuario");
            $stmt->bindValue(3, "$senha_convertida");

            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return array();
        }
    }
}

?>