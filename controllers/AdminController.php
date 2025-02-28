<?php
require 'models/Loja.php';
require 'models/Carro.php';
require 'models/Sponsor.php';
require 'globals_const.php';

class AdminController {
    private $loja;
    private $carro;

    private function __constructor() {
    }

    public function index() {
        require 'components/head.php';
        renderHead('Carro Aki | Admin');

        require 'views/Dashboards/DashboardIndex.php';
        require 'components/footer.php';
    }

    public function carros() {
        $carro = new Carro();
        $carros = $carro->listarCarros();

        require 'views/Dashboards/DashboardCarros.php';
    }

    public function lojas() {
        $loja = new Loja();
        $lojas = $loja->listarLojas();

        require 'views/Dashboards/DashboardLojas.php';
    }

    public function patrocinadores() {
        $sponsor = new Sponsor();
        $sponsors = $sponsor->getSponsorList();

        require 'views/Dashboards/DashboardSponsors.php';
    }

    public function adicionarPatrocinadores() {
        require 'src/utils.php';
        $sponsor = new Sponsor();
        $utils = new Utility();
        
        $pastaDestino = UPLOADS_DIR . '/patrocinadores/';
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
        }

        $patrocinador = array(
            "id" => $utils->gerarUUID(),
            "nome" => $_POST['nome'],
            "link" => $_POST['link'],
            "imagem" => $caminhoImagens
        );
        $sponsor->inserirPatrocinador($patrocinador);
        header("Location: /admin/patrocinadores/");
    }

    public function removerPatrocinadores() {
        $sponsor = new Sponsor();
        $id = $_GET['id'];
        $sponsor->removerPatrocinador($id);
        header('Location: /admin/patrocinadores');
    }
}

?>