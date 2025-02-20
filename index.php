<?php

session_start();
require_once 'Router.php';

$router = new Router();

// Rotas da Página Inicial
$router->addRoute("/", "HomeController@index");

// Rotas de Autorização
$router->addRoute("/login", "AuthController@login");
$router->addRoute("/register", "AuthController@register");

$router->dispatch();
?>