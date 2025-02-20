<?php
class Router {
    // Array para armazenar as rotas registradas
    private $routes;

    // Função para adicionar rotas
    function addRoute($path, $controllerAction) {
        global $routes;
        $routes[$path] = $controllerAction;
    }

    // Função para processar a URL e chamar o controller correto
    function dispatch() {
        global $routes;
        require 'config/database.php';

        // Obtém a URL acessada (remove query strings)
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($routes[$requestUri])) {
            // Divide "Controller@metodo"
            list($controller, $method) = explode('@', $routes[$requestUri]);

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
            echo "Erro 404 - Página não encontrada";
        }
    }
}

?>
