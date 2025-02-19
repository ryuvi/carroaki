<?php

include("components/head.php");
renderHead("Carro Aki | Home");

?>
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
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <?php endif; ?>
                    <?php if ($isLoggedIn): ?>
                        <?php if ($isAdmin): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Dashboard</a>
                            </li>
                        <?php endif; ?>
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
                                <img src="<?php echo file_exists($car['imagem']) ? $car['imagem'] : 'default-image.jpg'; ?>" class="card-img-top" alt="Imagem do carro">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
