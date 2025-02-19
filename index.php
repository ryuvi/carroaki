<?php
session_start();
include('config/db.php');
include('router.php'); // Inclusão do arquivo do roteador

foreach(glob("controllers/*.php") as $controller) {
    include($controller);
}

$router = new Router();
$router->addRoute("/", "HomeController@index"); // Definindo a rota principal
$router->addRoute("/login", "LoginController@login");
$router->addRoute("/logout", "LoginController@logout");
$router->addRoute("/cadastro", "CadastroController@cadastrar");

// Novas rotas para administração
$router->addRoute("/dashboard", "AdminController@dashboard");
$router->addRoute("/alterarStatusUsuario", "AdminController@alterarStatusUsuario");
$router->addRoute("/listarCarros", "AdminController@listarCarros");
$router->addRoute("/excluirCarro", "AdminController@excluirCarro");
$router->addRoute("/alterarStatusCarro", "AdminController@alterarStatusCarro");
$router->addRoute("/criarLoja", "AdminController@criarLoja");
$router->addRoute("/destacarCarro", "AdminController@destacarCarro");

// Chama o método para lidar com a requisição
$router->dispatch();
?>