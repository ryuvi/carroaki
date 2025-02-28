<?php

session_start();
require_once 'Router.php';

$router = new Router();

// Rotas da Página Inicial
$router->addRoute("/", "HomeController@index");

// Rotas de Autorização
$router->addRoute("/login", "AuthController@login");
$router->addRoute("/logout", "AuthController@logout");
$router->addRoute("/register", "AuthController@register");

$router->addRoute('/listarLojas', 'LojaController@getLojaLista');
$router->addRoute('/criarLoja', 'LojaController@criarLojaForm');

// Rotas de Admin
$router->group('/admin', function($route) {
    $route->addRoute('/', 'AdminController@index');
    $route->addRoute('/lojas', 'AdminController@lojas');
    $route->addRoute('/carros', 'AdminController@carros');
    $route->group('/patrocinadores', function($r) {
        $r->addRoute('/', 'AdminController@patrocinadores');
        $r->addRoute('/adicionar', 'AdminController@adicionarPatrocinadores');
        $r->addRoute('/remover', 'AdminController@removerPatrocinadores');
    });
});

// Rotas de Páginas
$router->group('/ver', function($route) {
    $route->addRoute('/loja', "LojaController@exibirLoja");
    $route->addRoute('/carro', "CarroController@exibirCarro");
});

// Rotas de Gerencia
$router->group('/manage', function($route) {

    // Rotas de Carro
    $route->group('/carro', function($r) {
        $r->addRoute("/", "CarroController@index");
        $r->addRoute("/deletar", "CarroController@deletarCarro");
        $r->addRoute("/inserir", "CarroController@inserirCarro");
        $r->addRoute("/destacar", "CarroController@destacarCarro");
    });

    //Rotas de Lojas
    $route->group('/loja', function ($r) {
        $r->addRoute("/", "LojaController@index");
        $r->addRoute("/deletar", "LojaController@deletarLoja");
        $r->addRoute("/inserir", "LojaController@inserirLoja");
        $r->addRoute("/selecinar", "LojaController@selecionarLoja");
        $r->addRoute("/bloquear", "LojaController@bloquearLoja");
        $r->addRoute("/desbloquear", "LojaController@desbloquearLoja");
    });
});

$router->dispatch();
?>