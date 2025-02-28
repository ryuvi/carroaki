<?php
require 'components/head.php';
renderHead('Carro Aki | Dashboard Carros');
require 'components/navbar.php';
?>
<div class="container p-2">
    <?php require 'components/error_success_message.php'; ?>
    <div class="container"></div>
    <div class="container">
        <button type="button" data-bs-toggle="modal"  data-bs-target="#inserircarro" class="btn btn-primary mb-2 ml-0 d-flex">
            <i class="bi bi-plus-square"></i>
            <p class="mx-2 my-auto">Adicionar Carros</p>
        </button>
    </div>

    <table class="table table-striped border border-light">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ano</th>
                <th>Preço</th>
                <?php if ($_SESSION['loja_nome'] == 'admin'): ?>
                    <th>Loja</th>
                <?php endif; ?>
                <th>Remover</th>
                <th>Destacar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($carros as $carro): ?>
                <tr>
                    <td><?php echo $carro['nome']; ?></td>
                    <td><?php echo $carro['ano']; ?></td>
                    <td><?php echo "R$ " . number_format($carro['preco'], 2, ',', '.'); ?></td>
                    <?php if ($_SESSION['loja_nome'] == 'admin'): ?>
                        <td><?php echo $carro['nome_loja']; ?></td>
                    <?php endif; ?>
                    <td><a href="/manage/carro/deletar?id=<?php echo htmlspecialchars($carro['id']); ?>" class="btn btn-danger"><i class="bi bi-trash"></i>Remover</a></td>
                    <td>
                    <?php if ($carro['destaque'] == 1): ?>
                        <a href="/manage/carro/destacar?id=<?php echo htmlspecialchars($carro['id']); ?>" class="btn btn-success mx-2 disabled">
                            <i class="bi bi-star"></i>
                            Destacar
                        </a>
                    <?php else: ?>
                        <a href="/manage/carro/destacar?id=<?php echo htmlspecialchars($carro['id']); ?>" class="btn btn-success mx-2" <?php echo $carro['destaque'] == 1 ? 'disabled' : ''; ?>>
                            <i class="bi bi-star"></i>
                            Destacar
                        </a>
                    <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    function abrirModal() {
        const myModal = new bootstrap.Modal("#inserircarro");
        myModal.show();
    }
</script>
<div class="modal fade" id="inserircarro" tab-index="-1" role="dialog" aria-labelledby="inserir-carro-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inserir-carro-label">Inserir Carro</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="close">
                </button>
            </div>
            <form action="/manage/carro/inserir" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="imagens" class="form-label">Selecione até 6 fotos do carro:</label>
                        <input type="file" id="imagens" multiple class="form-control" name="imagens[]">
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Insira o modelo do carro">
                    </div>
                    <!-- preco, ano, descrição, imagens, destaque -->
                     <div class="row">
                    <div class="mb-3 col">
                        <label for="preco" class="form-label">Preço</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="text" class="form-control" oninput="aplicarMascaraValor(event)" placeholder="00,00" name="preco" id="preco">
                            <script>
                                function aplicarMascaraValor(event) {
                                    var campo = event.target;
                                    var valor = campo.value.replace(/\D/g, '');  // Remove todos os caracteres não numéricos
                                        valor = valor.replace(/(\d{2})$/, ',$1');   // Coloca a vírgula antes dos dois últimos dígitos (centavos)
                                    valor = valor.replace(/(\d)(\d{3})(,)/, '$1.$2$3');  // Adiciona ponto a cada 3 dígitos
                                    valor = valor.replace(/(\d)(\d{3})(\.)/, '$1.$2$3'); // Adiciona ponto a cada 3 dígitos
                                    campo.value = valor;  // Adiciona o símbolo de R$
                                }
                            </script>
                        </div>
                    </div>
                    <div class="mb-3 col">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="text" class="form-control" id="ano" placeholder="AAAA" name="ano">
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Mais Informações</label>
                        <textarea name="descricao" id="descricao" class="form-control"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="destaque" id="destaque" class="form-check-input">
                        <label for="destaque" class="form-check-label">Destacar carro?</label>
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
<?php require 'components/footer.php'; ?>
