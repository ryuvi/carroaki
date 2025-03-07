<?php


class AuthController {
    private $session;
    private $utility;
    private $config;
    private $loja;

    public function __construct(){
        require_once 'models/Loja.php';

        require_once 'utils/session.php';
        require_once 'utils/config.php';
        require_once 'utils/utility.php';
        
        // $this->session = Session::getInstance();
        $this->session = Session::getInstance();
        $this->utility = Utility::getInstance();
        $this->config = Config::getInstance();
        $this->loja = new Loja();
    }

    private function redirectToHome() {
        header('Location: /');
        exit;
    }

    private function loginIndex() {
        require_once 'components/head.php';
        renderHead('Carro Aki | Login');
        require_once 'components/navbar.php';

        require_once 'views/usuario/LoginFormView.php';
        require_once 'components/footer.php';
    }
    
    private function registerIndex() {
        require_once 'components/head.php';
        renderHead('Carro Aki | Cadastrar');
        require_once 'components/navbar.php';
        
        require_once 'views/usuario/RegisterFormView.php';
        require_once 'components/footer.php';
    }

    public function logout() {
        $this->session->destroy();
        $this->redirectToHome();
    }

    public function login() {        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if ($this->loja->verificarLoja($_POST['username'], $_POST['password'])) {

                $loja_id = $this->loja->getLojaId($_POST['username'], $_POST['password']);
                $loja_nome = '';

                if (strpos($_POST['username'], '@') !== false) {
                    $loja_nome = $this->loja->getLojaNome($loja_id);
                } else {
                    $loja_nome = $_POST['username'];
                }

                $this->session->set('loja_nome', $loja_nome);
                $this->session->set('loja_id', $loja_id);

                $this->redirectToHome();
            } else {
                $this->session->set("tipo", "danger");
                $this->session->set("mensagem", "Sua loja está bloqueada!");
                $this->loginIndex();
            }
        } else {
            $this->loginIndex();
        }
    }


    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!$this->loja->verificarLoja($_POST['username'], $_POST['password'])) {

                $pastaDestino = $this->config->get('uploads_dir') . '/' . $_POST['username'] . '/';
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
                    $caminhoImagens = $this->config->get('uploads_dir') . "/default/banner.jpg";
                }

                $uuid = $this->utility->gerarUUID();
                $values = array(
                    "id" => $uuid,
                    "nome" => $_POST['username'],
                    "email" => $_POST['email'],
                    "password" => md5($_POST['password']),
                    "banner" => $caminhoImagens,
                    "descricao" => $_POST['descricao'],
                    "cidade" => $_POST['city']
                );

                $error = $this->loja->criarLoja($values);
                if ($error !== '') {
                    $this->session->set('tipo', 'danger');
                    $this->session->set('mensagem', $error);
                    $this->registerIndex();
                } else {
                    $this->session->set('loja_nome', $_POST['username']);
                    $this->session->set('loja_id', $uuid);
                    $this->redirectToHome();
                }

            } else {
                $this->session->set('tipo', 'danger');
                $this->session->set('mensagem', 'Loja já existe!');
                $this->registerIndex();
            }
        } else {
            $this->registerIndex();
            
        }
    }
}

?>