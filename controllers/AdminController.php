<?php
require_once 'models/Usuario.php';
require_once 'models/Carro.php';
require_once 'models/Loja.php';
require_once 'models/Favorito.php';

class AdminController {
    private $pdo;
    private $usuarioModel;
    private $carroModel;
    private $lojaModel;
    private $favoritoModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->usuarioModel = new Usuario($pdo);
        $this->carroModel = new Carro($pdo);
        $this->lojaModel = new Loja($pdo);
        $this->favoritoModel = new Favorito($pdo);
    }

    // Função para carregar o Dashboard
    public function dashboard() {
        // Listar usuários
        $usuarios = $this->usuarioModel->obterTodos();

        // Passar dados para a View
        include 'views/dashboard.php';
    }

    // Função para bloquear ou desbloquear um usuário
    public function alterarStatusUsuario($usuario_id, $status) {
        $this->usuarioModel->atualizarStatusPagamento($usuario_id, $status);
        header('Location: /admin/dashboard');
    }

    // Função para listar carros de um cliente
    public function listarCarros($usuario_id) {
        $carros = $this->carroModel->obterPorCliente($usuario_id);
        include 'views/lista_carros.php'; // View que lista os carros
    }

    // Função para excluir um carro
    public function excluirCarro($carro_id) {
        $this->carroModel->excluirCarro($carro_id);
        header('Location: /admin/dashboard');
    }

    // Função para atualizar o status do carro
    public function alterarStatusCarro($carro_id, $status) {
        $this->carroModel->atualizarStatus($carro_id, $status);
        header('Location: /admin/dashboard');
    }

    // Função para criar uma nova loja
    public function criarLoja($nome, $cliente_id) {
        $this->lojaModel->criar($nome, $cliente_id);
        header('Location: /admin/dashboard');
    }

    // Função para marcar um carro como destaque na loja
    public function destacarCarro($carro_id, $loja_id) {
        $this->favoritoModel->marcarDestaque($carro_id, $loja_id);
        header('Location: /admin/dashboard');
    }

    // Função para remover destaque de um carro
    public function removerDestaque($carro_id, $loja_id) {
        $this->favoritoModel->removerDestaque($carro_id, $loja_id);
        header('Location: /admin/dashboard');
    }
}
?>
