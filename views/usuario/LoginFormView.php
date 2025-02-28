<div class="container mt-5">
    <h2>Login</h2>
    <?php require 'components/error_success_message.php'; ?>
    <form method="POST" action="/login">
        <div class="mb-3">
            <label for="username" class="form-label">Nome da Loja/Email</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Nome da Loja/Email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <small>Não tem uma conta ainda? <a href="/register">Cadastre-se agora!</a></small>
        </div>
        <button type="submit" class="btn btn-primary d-flex">
            <p class="my-auto mx-2">
                Entrar
            </p>
            <i class="bi bi-box-arrow-in-right my-auto"></i>
        </button>
    </form>
</div>

