<?php
class Router {
    // Array para armazenar as rotas registradas
    private $routes = array();
    private $groupPrefix = '';

    // Função para adicionar rotas
    function addRoute($path, $controllerAction) {
        $fullPath = rtrim($this->groupPrefix . $path, '/');
        if ($fullPath === '') {
            $fullPath = '/';
        }
        $this->routes[$fullPath] = $controllerAction;
    }

    // Função para agrupar rotas com prefixo
    function group($prefix, $callback) {
        $previousPrefix = $this->groupPrefix;
        $this->groupPrefix .= $prefix;

        call_user_func($callback, $this);

        $this->groupPrefix = $previousPrefix;
    }

    // Função para processar a URL e chamar o controller correto
    function dispatch() {
        require 'config/database.php';

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
            require 'views/404.php';
        }
    }
}

?>
