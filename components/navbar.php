<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
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
