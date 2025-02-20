<?php

class HomeController {

    // Construtor da classe, inicializando o modelo e a conexão com o banco de dados
    public function __construct() {}

    // Método index, que será chamado para exibir a página inicial de carros
    public function index() {
        require 'models/Carro.php';
        require 'config/database.php';

        $carroModel = new Carro($pdo);

        // Verifica se o usuário está logado e se é admin
        $isLoggedIn = isset($_SESSION['user']) && $_SESSION['user'] === 'admin';

        // Obter parâmetros de filtro da URL
        $anoFiltro = isset($_GET['ano']) ? $_GET['ano'] : '';
        $lojaFiltro = isset($_GET['loja']) ? $_GET['loja'] : '';

        // Obter a lista de carros filtrados do modelo
        $cars = $carroModel->listarCarros($anoFiltro, $lojaFiltro);

        // Incluir o cabeçalho e a navbar
        require 'components/head.php';
        renderHead('Carro Aki | Home');
        require 'components/navbar.php';
        require 'views/FormBuscaView.php';
        require 'views/CarroListaView.php';
        require 'components/footer.php';
    }
}

?>
