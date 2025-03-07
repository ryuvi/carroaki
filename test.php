<?php

class HomeController {
    private $carro;
    private $database;
    private $authController;
    private $utility;
    private $template;

    // Construtor da classe, inicializando o modelo e a conexão com o banco de dados
    public function __construct() {
        require_once 'models/Carro.php';
        require_once 'controllers/AuthController.php';
        require_once 'config/database.php';
        require_once 'utils/utility.php';
        require_once 'utils/template.php';

        $this->carro = new Carro();
        $this->authController = new AuthController();
        $this->database = Database::getInstance();
        $this->utility = Utility::getInstance();
        $this->template = new Template();
    }

    // Método index, que será chamado para exibir a página inicial de carros
    public function index() {
        // Obter parâmetros de filtro da URL
        $anoFiltro = isset($_GET['ano']) ? $_GET['ano'] : '';
        $lojaFiltro = isset($_GET['loja']) ? $_GET['loja'] : '';
        $cidadeFiltro = isset($_GET['city']) ? $_GET['city'] : '';

        // Renderizar o formulário de busca
        $form = $this->template->render('home/FormBuscaView.php', array(
            'anoFiltro' => $anoFiltro, 
            'lojaFiltro' => $lojaFiltro, 
            'cidadeFiltro' => $cidadeFiltro
        ));

        // Obter a lista de carros filtrados do modelo
        $cars = $this->carro->listarCarros($anoFiltro, $lojaFiltro, $cidadeFiltro);

        // Renderizar o conteúdo principal da página com a lista de carros
        $home = $this->template->render('home/HomeView.php', array(
            'form' => $form,
            'cars' => $cars
        ));

        // Renderizar a BaseView (layout), passando o conteúdo gerado de HomeView para o corpo
        $this->template->render('layouts/BaseView.php', array(
            'title' => 'Carro Aki | Home',
            'conteudo' => $home // Aqui você passa o conteúdo para a BaseView
        ));
    }
}

?>
