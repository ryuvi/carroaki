<?php

class Template {
    // Diretório base onde as views estão localizadas
    private $viewPath;

    // Construtor para definir o diretório de views
    public function __construct($viewPath = 'views/') {
        $this->viewPath = $viewPath; // Definir a pasta base de views
    }

    // Função para renderizar a view
    public function render($view, $dados = array()) {
        extract($dados);  // Extrair dados para o escopo global

        ob_start();  // Inicia o buffer de saída

        $viewFile = $this->viewPath . $view;  // Caminho completo para a view

        if (!file_exists($viewFile)) {
            throw new Exception("A view não foi encontrada: " . $viewFile);
        }

        require_once $viewFile;  // Inclui o arquivo da view

        $content = ob_get_clean();  // Captura a saída

        // Se a view for a base, processa o layout
        if ($view == 'layouts/BaseView.php') {
            return $this->renderBase($content, $dados);  // Passa o conteúdo para o layout
        } else {
            return $content;  // Retorna o conteúdo gerado da view
        }
    }

    // Função para renderizar o layout base
    private function renderBase($content, $dados) {
        extract($dados);  // Extrai os dados para o layout
        ob_start();

        require_once 'models/Sponsor.php';
        $sponsor = new Sponsor();
        $sponsors = $sponsor->getSponsorList();

        // Inclui o arquivo do layout base
        require_once $this->viewPath . 'layouts/BaseView.php';

        return ob_get_clean();  // Retorna o conteúdo final do layout
    }
}
?>
