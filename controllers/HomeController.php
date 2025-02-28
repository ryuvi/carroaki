<?php

class HomeController {

    // Construtor da classe, inicializando o modelo e a conexão com o banco de dados
    public function __construct() {}

    // Método index, que será chamado para exibir a página inicial de carros
    public function index() {
        require 'models/Carro.php';
        require 'controllers/AuthController.php';
        require 'config/database.php';
        require 'models/Sponsor.php';

        $auth = new AuthController();
        $carroModel = new Carro($pdo);
        $sponsor_model = new Sponsor();
        $sponsors = $sponsor_model->getSponsorList();

        // Verifica se o usuário está logado e se é admin
        // $isLoggedIn = $auth->getUsuarioLogado();

        // Obter parâmetros de filtro da URL
        $anoFiltro = isset($_GET['ano']) ? $_GET['ano'] : '';
        $lojaFiltro = isset($_GET['loja']) ? $_GET['loja'] : '';

        // Obter a lista de carros filtrados do modelo
        $cars = $carroModel->listarCarros($anoFiltro, $lojaFiltro);

        // Incluir o cabeçalho e a navbar
        require 'views/HomeView.php';
    }
}

?>
