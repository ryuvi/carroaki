<?php

require 'globals_const.php';

class LojaController {
    public function index() {
        require 'models/Loja.php';

        $loja = new Loja();
        $lojas = $loja->listarLojas();

        require 'views/Dashboards/DashboardLojas.php';
    }

    public function exibirLoja() {
        require 'models/Loja.php';
        require 'models/Carro.php';

        $loja = new Loja();
        $carro = new Carro();
        $loja_id = $_GET['id'];

        $carros = $carro->listarCarros('', $loja_id);
        $sLoja = $loja->getLoja($loja_id);
        $banner = $sLoja->banner;
        $nome = $sLoja->nome;
        $biografia = $sLoja->informacoes;

        require 'views/loja/LojaIndex.php';
    }

    public function getLojaLista() {
        require 'models/Loja.php';
        $loja = new Loja();
        $lojas = $loja->listarLojas($usuario->getUsuarioId($_GET['username']));
        echo json_encode($lojas);
    }

    private function goBack() {
        header('Location: /manage/loja/');
    }

    public function bloquearLoja() {
        require 'models/Loja.php';
        $loja = new Loja();
        $loja->bloquearLoja($_GET['id']);
        $this->goBack();
    }

    public function desbloquearLoja() {
        require 'models/Loja.php';
        $loja = new Loja();
        $loja->desbloquearLoja($_GET['id']);
        $this->goBack();
    }

    public function deletarLoja() {
        require 'models/Loja.php';
        require 'models/Carro.php';
        $carro = new Carro();
        $loja = new Loja();
        $carro->deletarTodosCarros($_GET['id']);
        $loja->deletarLoja($_GET['id']);
        $this->goBack();
    }

    public function selecionarLoja() {
        $_SESSION['loja_id'] = $_GET['id'];
        $_SESSION['loja_nome'] = $_GET['nome'];
        header('Location: /');
    }

    public function criarLojaForm() {
        require 'components/head.php';
        renderHead('Carro Aki | Loja');
        require 'components/navbar.php';

        require 'views/loja/RegisterLojaFormView.php';

        require 'components/footer.php';
    }

    public function inserirLoja() {
        require 'models/Loja.php';
        require 'src/utils.php';
        $loja = new Loja();
        $utils = new Utility();

        $pastaDestino = UPLOADS_DIR . '/' . $_POST['nome'] . '/';
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


        $store = array(
            "id" => $utils->gerarUUID(),
            "nome" => $_POST['nome'],
            "email" => $_POST['email'],
            "descricao" => $_POST['descricao'],
            "banner" => $caminhoImagens,
        );

        $loja->criarLoja($store);
        $this->goBack();
    }
}

?>