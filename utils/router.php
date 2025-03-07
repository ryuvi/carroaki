<?php

class Router {
    // Array para armazenar as rotas registradas
    private $routes = array();
    private $groupPrefix = '';
    
    // Instância estática para implementar o Singleton
    private static $instance = null;

    // Construtor privado para evitar criação de instâncias fora da classe
    private function __construct() {}

    // Método para acessar a instância única da classe
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Router(); // Cria a instância se não existir
        }

        return self::$instance; // Retorna a instância única
    }

    // Função para adicionar rotas
    public function addRoute($path, $controllerAction) {
        $fullPath = rtrim($this->groupPrefix . $path, '/');
        if ($fullPath === '') {
            $fullPath = '/';
        }
        $this->routes[$fullPath] = $controllerAction;
    }

    // Função para agrupar rotas com prefixo
    public function group($prefix, $callback) {
        $previousPrefix = $this->groupPrefix;
        $this->groupPrefix .= $prefix;

        call_user_func($callback, $this);

        $this->groupPrefix = $previousPrefix;
    }

    // Função para processar a URL e chamar o controller correto
    public function dispatch() {

        // Obtém a URL acessada (remove query strings)
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $normalizedUri = rtrim($requestUri, '/');

        if ($normalizedUri === '') {
            $normalizedUri = '/';
        }

        if (isset($this->routes[$normalizedUri])) {
            // Divide "Controller@metodo"
            list($controller, $method) = explode('@', $this->routes[$normalizedUri]);

            // Inclui o arquivo do controller
            $controllerFile = "controllers/" . $controller . ".php";

            if (file_exists($controllerFile)) {
                include_once $controllerFile;
                $controllerInstance = new $controller();

                if (method_exists($controllerInstance, $method)) {
                    // Chama o método do controller
                    $controllerInstance->$method();
                    exit;
                } else {
                    die("Erro: Método '$method' não encontrado no controller '$controller'.");
                }
            } else {
                die("Erro: Arquivo do controller '$controllerFile' não encontrado.");
            }
        } else {
            http_response_code(404);
            require_once 'views/404.php';
        }
    }

    // Impede a clonagem da instância
    private function __clone() {}

    // Impede a desserialização da instância
    public function __wakeup() {}
}

?>
