<?php
require 'components/head.php';
renderHead('Carro Aki | Lojas');
require 'components/navbar.php';
?>

<div class="container p-2">

    <?php require 'components/error_success_message.php'; ?>

    <table class="table table-striped border border-light">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>Bloquear/Desbloquear</th>
                <th>Deletar</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lojas as $loja): ?>
            <tr>
                <td><?php echo $loja['nome']; ?></td>
                <td><?php echo $loja['email']; ?></td>
                <td><?php echo $loja['ativo'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                <?php if ($loja['ativo'] == 0): ?>
                    <td>
                    <a href="/manage/loja/desbloquear?id=<?php echo $loja['id']; ?>" class="btn btn-success" style='width: 50%;'>
                        <i class="bi bi-unlock"></i>
                        Desbloquear
                    </a>
                    </td>

                <?php else: ?>

                    <td>
                        <a href="/manage/loja/bloquear?id=<?php echo $loja['id']; ?>" class="btn btn-warning" style='width: 50%;'>
                            <i class="bi bi-lock"></i>
                            Bloquear
                        </a>
                    </td>
                <?php endif; ?>
                <td>
                <a href="/manage/loja/deletar?id=<?php echo $loja['id']; ?>" class="btn btn-danger">
                    <i class="bi bi-x-circle"></i>
                    Deletar
                </a>
                </td>
                <td>
                    <a href="/ver/loja?id=<?php echo $loja['id']; ?>" class="btn btn-dark"><i class="bi bi-eye" style="margin-right: .15rem;"></i>Ver</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php require 'components/footer.php'; ?>
