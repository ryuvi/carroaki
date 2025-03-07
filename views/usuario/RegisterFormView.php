<div class="container my-2">
    <h2>Cadastrar</h2>
    <?php require_once 'components/error_success_message.php'; ?>
    <form method="POST" action="/register">
        <div class="mb-3">
            <label for="username" class="form-label">Nome</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Nome da loja" require_onced>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email da loja">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Senha de acesso" require_onced>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Selecione a cidade:</label>
            <select name="city" id="city" class="form-select">
                <option value="São José dos Campos">São José dos Campos</option>
                <option value="Jacareí">Jacareí</option>
                <option value="Caçapava">Caçapava</option>
                <option value="Taubaté">Taubaté</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="imagens" class="form-label">Selecione o banner da loja:</label>
            <input type="file" id="imagens" class="form-control" name="imagens">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Mais Informações</label>
            <textarea name="descricao" id="descricao" class="form-control" placeholder="Outras informações relevantes da loja..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary d-flex">
            <p class="my-auto mx-2">
                Cadastrar
            </p>
            <i class="bi bi-person-add my-auto"></i>
        </button>
    </form>
</div>