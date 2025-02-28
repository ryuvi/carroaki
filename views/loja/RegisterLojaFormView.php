<form action="/manage/loja/inserir" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="imagens" class="form-label">Selecione o banner da loja:</label>
        <input type="file" id="imagens" class="form-control" name="imagens">
    </div>
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Loja</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome da loja">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email da loja</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Insira o email da loja">
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label">Mais Informações</label>
        <textarea name="descricao" id="descricao" class="form-control"></textarea>
    </div>
<button class="btn btn-primary" type="submit">Inserir</a>
</form>