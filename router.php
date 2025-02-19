<?php
class Router {
    private $routes = [];

    // Adiciona uma rota
    public function addRoute($path, $action) {
        $this->routes[$path] = $action;
    }

    // Dispara a ação correspondente à URL
    public function dispatch() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Verifica se a URL existe no array de rotas
        if (array_key_exists($url, $this->routes)) {
            list($controller, $method) = explode('@', $this->routes[$url]);
            
            // Instancia o controller e chama o método
            if (class_exists($controller)) {
                $controllerObj = new $controller();
                if (method_exists($controllerObj, $method)) {
                    $controllerObj->$method();
                    exit(); // Evita continuar o script
                } else {
                    echo "Método não encontrado!";
                }
            } else {
                echo "Controller não encontrado!";
            }
        } else {
            echo "Rota não encontrada!";
        }
    }
}
?>