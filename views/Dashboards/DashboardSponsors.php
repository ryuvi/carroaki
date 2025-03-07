<?php
require_once 'components/head.php';
renderHead('Carro Aki | Admin Usuarios');
require_once 'components/navbar.php';
?>
<div class="container p-2">
    <h3>Gerenciador Patrocinadores</h3>

    <div class="container">
        <button type="button" data-bs-toggle="modal"  data-bs-target="#inserirPatrocinador" class="btn btn-primary mb-2 ml-0 d-flex">
            <i class="bi bi-plus-square"></i>
            <p class="mx-2 my-auto">Adicionar Patrocinador</p>
        </button>
    </div>

    <ul class="list-group">
        <?php foreach($sponsors as $sponsor): ?>
            <li class="list-group-item d-flex justify-content-between">
                <p class="my-auto"><?php echo $sponsor->nome; ?></p>
                <a href="/admin/patrocinadores/remover?id=<?php echo $sponsor->id; ?>" class="btn btn-danger"><i class="bi bi-x-circle me-2"></i>Deletar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    function abrirModal() {
        const myModal = new bootstrap.Modal("#inserirPatrocinador");
        myModal.show();
    }
</script>

<div class="modal fade" id="inserirPatrocinador" tab-index="-1" role="dialog" aria-labelledby="inserir-patrocinador-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inserir-patrocinador-label">Inserir Patrocinador</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="close">
                </button>
            </div>
            <form action="/admin/patrocinadores/adicionar" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="imagens" class="form-label">Imagem:</label>
                        <input type="file" id="imagens" class="form-control" name="imagens">
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome da loja">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link:</label>
                        <input type="text" class="form-control" id="link" name="link" placeholder="Insira o email da loja">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" type="submit">Inserir</a>
            </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'components/footer.php'; ?>
