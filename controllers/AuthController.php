<?php

require 'models/Loja.php';
require 'src/utils.php';
require 'globals_const.php';

class AuthController {
    public function __construct(){}

    public function logout() {
        unset($_SESSION['loja_id']);
        unset($_SESSION['loja_nome']);
        header('Location: /');
    }

    public function loginIndex($error = null) {
        require 'components/head.php';
        renderHead('Carro Aki | Login');
        require 'components/navbar.php';
        require 'views/usuario/LoginFormView.php';
        require 'components/footer.php';
    }

    public function login() {
        require 'config/database.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $loja = new Loja();

            if ($loja->verificarLoja($_POST['username'], $_POST['password'])) {

                $_SESSION['loja_nome'] = $_POST['username'];
                $_SESSION['loja_id'] = $loja->getLojaId($_POST['username'], $_POST['password']);

                header('Location: /');
            } else {
                $error = "Sua loja está bloqueada!";
                $this->loginIndex($error);
            }
        } else {
            $this->loginIndex();
        }
    }

    public function registerIndex($error = null) {
        require 'components/head.php';
            renderHead('Carro Aki | Cadastrar');
            require 'components/navbar.php';
            
            require 'views/usuario/RegisterFormView.php';
            require 'components/footer.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            require 'config/database.php';

            $loja = new Loja();
            $utils = new Utility();
            if (!$loja->verificarLoja($_POST['username'], $_POST['password'])) {

                $pastaDestino = UPLOADS_DIR . '/' . $_POST['username'] . '/';
                $caminhoImagens = '';

                if (!is_dir($pastaDestino)) {
                    mkdir($pastaDestino, 0777, true);
                }

                if (!empty($_FILES['imagens']['name'][0])) {
                    $nomeOriginal = $_FILES['imagens']['name'];
                    $tmpName = $_FILES['imagens']['tmp_name'];
                    $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);

                    $novoNome = uniqid().".".$extensao;
                    $caminhoCompleto = $pastaDestino.$novoNome;

                    if (move_uploaded_file($tmpName, $caminhoCompleto)) {
                        $caminhoImagens = $caminhoCompleto;
                    }
                } else {
                    $caminhoImagens = UPLOADS_DIR . "/default/banner.jpg";
                }

                $values = array(
                    "id" => $utils->gerarUUID(),
                    "nome" => $_POST['username'],
                    "email" => $_POST['email'],
                    "password" => md5($_POST['password']),
                    "banner" => $caminhoImagens,
                    "descricao" => $_POST['descricao']
                );

                $error = $loja->criarLoja($values);
                if ($error !== '') {
                    $this->registerIndex($error);
                } else {
                    $_SESSION['loja_nome'] = $_POST['username'];
                    $_SESSION['loja_id'] = $loja->getLojaId($_POST['username'], $_POST['password']);
                    header('Location: /');
                }

            } else {
                $error = "Loja já existe!";
                $this->registerIndex($error);
            }
        } else {
            $this->registerIndex();
            
        }
    }
}

?>