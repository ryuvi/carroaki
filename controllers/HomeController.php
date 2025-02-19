<?php

class HomeController {
    // Ação para exibir a página inicial
    public function index() {
        include("config/db.php");
        // Verifica se o usuário está logado e é admin
        $isLoggedIn = isset($_SESSION['user']);
        $isAdmin =  $_SESSION['user'] === 'admin';
        
        // Obtém os parâmetros de filtro da URL
        $marcaFiltro = isset($_GET['marca']) ? htmlspecialchars($_GET['marca']) : '';
        $modeloFiltro = isset($_GET['modelo']) ? htmlspecialchars($_GET['modelo']) : '';
        $precoMinFiltro = isset($_GET['preco_min']) ? (float) $_GET['preco_min'] : '';
        $precoMaxFiltro = isset($_GET['preco_max']) ? (float) $_GET['preco_max'] : '';

        // Monta a consulta SQL com os filtros
        $sql = "SELECT * FROM carros WHERE 1=1";

        if ($marcaFiltro) {
            $sql .= " AND marca LIKE ?";
        }
        if ($modeloFiltro) {
            $sql .= " AND modelo LIKE ?";
        }
        if ($precoMinFiltro) {
            $sql .= " AND preco >= ?";
        }
        if ($precoMaxFiltro) {
            $sql .= " AND preco <= ?";
        }

        $stmt = $pdo->prepare($sql);

        // Vincula os parâmetros dos filtros
        $paramIndex = 1;
        if ($marcaFiltro) {
            $stmt->bindValue($paramIndex++, "%$marcaFiltro%");
        }
        if ($modeloFiltro) {
            $stmt->bindValue($paramIndex++, "%$modeloFiltro%");
        }
        if ($precoMinFiltro) {
            $stmt->bindValue($paramIndex++, $precoMinFiltro);
        }
        if ($precoMaxFiltro) {
            $stmt->bindValue($paramIndex++, $precoMaxFiltro);
        }

        $stmt->execute();
        $cars = $stmt->fetchAll();

        // Exibe a view com os dados dos carros
        include('views/homeView.php');
    }
}
?>