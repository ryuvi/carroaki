<?php
require_once 'models/Loja.php';
require_once 'models/Carro.php';
require_once 'models/Sponsor.php';
require_once 'globals_const.php';

class AdminController {
    private $loja;
    private $carro;

    private function __constructor() {
    }

    public function index() {
        require_once 'components/head.php';
        renderHead('Carro Aki | Admin');

        require_once 'views/Dashboards/DashboardIndex.php';
        require_once 'components/footer.php';
    }

    public function carros() {
        $carro = new Carro();
        $carros = $carro->listarCarros();

        require_once 'views/Dashboards/DashboardCarros.php';
    }

    public function lojas() {
        $loja = new Loja();
        $lojas = $loja->listarLojas();

        require_once 'views/Dashboards/DashboardLojas.php';
    }

    public function patrocinadores() {
        $sponsor = new Sponsor();
        require_once 'src/utils.php';
        $sponsors = $sponsor->getSponsorList();
        $utils = new Utility();

        require_once 'views/Dashboards/DashboardSponsors.php';
    }

    public function adicionarPatrocinadores() {
        require_once 'src/utils.php';
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
