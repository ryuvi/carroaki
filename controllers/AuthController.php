<?php

class AuthController {
    public function __construct(){}

    public function login() {
        require 'models/Usuario.php';
        require 'config/database.php';

        $usuario = new Usuario();
        if ($usuario->verificarUsuario($_POST['username'], $_POST['password'])) {
            echo "Logado!";
        } else {
            echo "Não Logado!";
        }

        // Incluir o cabeçalho e a navbar
        require 'components/head.php';
        renderHead('Carro Aki | Login');
        require 'components/navbar.php';
        
        require 'views/LoginFormView.php';

        require 'components/footer.php';
    }

    public function register() {
        require 'models/Usuario.php';
        require 'config/database.php';

        $usuario = new Usuario();
        if (!$usuario->verificarUsuario($_POST['username'], $_POST['password'])) {
            $usuario->cadastrarUsuario($_POST['username'], $_POST['password']);
            echo "Usuario cadastrado!";
        } else {
            echo "Usuario já existe!";
        }

        // Incluir o cabeçalho e a navbar
        require 'components/head.php';
        renderHead('Carro Aki | Login');
        require 'components/navbar.php';
        
        require 'views/RegisterFormView.php';

        require 'components/footer.php';
    }
}

?>