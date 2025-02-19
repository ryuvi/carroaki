<?php
// controllers/CadastroController.php

class CadastroController {
    private $usuario;

    public function __construct() {
        include('config/db.php');
        include('models/Usuario.php');
        $this->usuario = new Usuario($pdo);
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = md5($_POST['password']); // Aplica MD5 antes de salvar
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];

            // Verifica se o usuário já existe
            $user = $this->usuario->verificaExistencia($username);

            if ($user) {
                $error = 'Usuário já existe.';
                include('views/cadastroView.php');
                return;
            }

            // Cadastra o novo usuário
            if ($this->usuario->cadastrar($username, $password, $email, $telefone, $endereco)) {
                $_SESSION['user'] = $username;
                header('Location: index.php');
                exit();
            } else {
                $error = 'Erro ao cadastrar usuário.';
                include('views/cadastroView.php');
                return;
            }
        }

        // Caso o método não seja POST, apenas exibe o formulário de cadastro
        include('views/cadastroView.php');
    }
}
?>