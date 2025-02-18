<?php
session_start();
include('db.php');

// Verifica se o usuário está logado e se é admin
$isLoggedIn = isset($_SESSION['user']) && $_SESSION['user'] === 'admin';

// Obter parâmetros de filtro
$marcaFiltro = isset($_GET['marca']) ? $_GET['marca'] : '';
$modeloFiltro = isset($_GET['modelo']) ? $_GET['modelo'] : '';
$precoMinFiltro = isset($_GET['preco_min']) ? $_GET['preco_min'] : '';
$precoMaxFiltro = isset($_GET['preco_max']) ? $_GET['preco_max'] : '';

// Construção da consulta SQL com filtros
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

// Vincula os filtros
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carro Aki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    display: flex;
    flex-direction: column;
    background-color: #f4f4f9;
}

/* Garante que a página ocupe toda a altura disponível */
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Navbar */
.navbar {
    background-color: #1a1a1a;
}

.navbar-brand, .nav-link {
    color: #ffffff !important;
}

.nav-link:hover {
    color: #ff7043 !important;
}

/* Filtros responsivos */
.filters {
    margin-bottom: 30px;
    margin-top: 30px;
}

@media (max-width: 768px) {
    .filters .row {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
}

/* Cartões de carros */
.card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: auto;
    width: 100%;
    max-width: 400px;
    margin: auto;
}

.card:hover {
    transform: scale(1.05);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-body {
    padding: 20px;
}

/* Botões */
.btn-primary {
    background-color: #ff7043;
    border-color: #ff7043;
}

.btn-primary:hover {
    background-color: #e64a19;
    border-color: #e64a19;
}

/* Footer fixo no rodapé */
.footer {
    background-color: #1a1a1a;
    color: white;
    padding: 15px;
    text-align: center;
    width: 100%;
    margin-top: auto;
}

/* Responsividade */
@media (max-width: 576px) {
    .card {
        max-width: 100%;
    }
}

.informacoes-basicas {
    width: 100%;
    display: flex;
    justify-content: space-between;
    color: grey;
    font-size: 9pt;
}

    </style>
</head>
<body>
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark p-2">
            <a class="navbar-brand" href="index.php">Carro Aki</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (!$isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php endif; ?>
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastro.php">Cadastrar Carro</a>
                        </li>
                        <li class="nav-item">
                            <a href="remover.php" class="nav-link">Remover Carro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <!-- Filtro de Carros -->
        <div class="container filters">
            <form method="get">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="marca" class="form-control" placeholder="Marca" value="<?php echo htmlspecialchars($marcaFiltro); ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="modelo" class="form-control" placeholder="Modelo" value="<?php echo htmlspecialchars($modeloFiltro); ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="preco_min" class="form-control" placeholder="Preço Min" value="<?php echo htmlspecialchars($precoMinFiltro); ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="preco_max" class="form-control" placeholder="Preço Máx" value="<?php echo htmlspecialchars($precoMaxFiltro); ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Lista de Carros -->
        <div class="container">
            <div class="row">
                <?php foreach ($cars as $car): ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                            <!-- Imagem ou Vídeo -->
                            <?php if (in_array(pathinfo($car['imagem'], PATHINFO_EXTENSION), array('mp4', 'avi', 'mov'))): ?>
                                <video class="card-img-top" controls>
                                    <source src="<?php echo $car['imagem']; ?>" type="video/mp4">
                                    Seu navegador não suporta o vídeo.
                                </video>
                            <?php else: ?>
                                <img src="<?php echo $car['imagem']; ?>" class="card-img-top" alt="Imagem do carro">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title" style="margin-bottom: 0;"><?php echo htmlspecialchars($car['modelo']); ?></h5>
                                <small class="card-text informacoes-basicas">
                                    <span><?php echo htmlspecialchars($car['potencia']); ?></span> • 
                                    <span><?php echo htmlspecialchars($car['cambio']); ?></span> • 
                                    <span><?php echo htmlspecialchars($car['combustivel']); ?></span>
                                </small>
                                <p class="card-text" style="margin-top: 2rem; margin-bottom: 0;">Preço: R$ <?php echo number_format($car['preco'], 2, ',', '.'); ?></p>
                                <small class="informacoes-basicas"><span><?php echo htmlspecialchars($car['ano']); ?></span><span><?php echo htmlspecialchars($car['quilometragem']); ?></span></small>
                                <a href='tel:<?php echo htmlspecialchars($car['contato']); ?>' class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Contato</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Carro Aki. Todos os direitos reservados.</p>
    </div>

    <script>
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === "hidden") {
                fetch('logout.php', {method: 'POST'})
            }
        })
    </script>

    <script>
        let tempoInatividade;
        function resetTimer() {
            clearTimeout(tempoInatividade);
            tempoInatividade = setTimeout(function() {
                fetch("logout.php", {method: "POST"});
            }, 600000);
        }

        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('keypress', resetTimer);

        resetTimer();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
