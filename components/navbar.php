<?php
// $isLoggedIn = true;
// $_SESSION['usuario'] = 'admin';
// $_SESSION['usuario'] = 'joao_silva';
// $_SESSION['loja_id'] = '5925e76c-3d05-4c55-9a87-3de8efb1ca7a';
// $_SESSION['loja_nome'] = 'admin';
$isLoggedIn = false;

if (isset($_SESSION) && array_key_exists("loja_nome", $_SESSION)) {
    $isLoggedIn = true;
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 px-md-5 px-3">
    <a class="navbar-brand fs-3" href="/">Carro Aki</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse px-2" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <?php if (!$isLoggedIn): ?>
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <?php endif; ?>
            <?php if ($isLoggedIn): ?>
                <!-- <li class="nav-link">
                    <?php //echo $_SESSION['usuario']; ?>
                </li>
                <li class="nav-link">|</li> -->
                <li class="nav-item">
                    <a href="/" class="nav-link">Inicio</a>
                </li>
                <?php if ($_SESSION['loja_nome'] === 'admin'): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Gerenciar
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/admin/lojas">Gerenciar Lojas</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/admin/carros">Gerenciar Carros</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/admin/patrocinadores">Gerenciar Patrocinadores</a>
                        </li>
                    </ul>
                </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/manage/carro/">Gerenciar Carros</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
