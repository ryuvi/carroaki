<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Carros do Cliente</h1>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carros as $carro): ?>
                    <tr>
                        <td><?php echo $carro['id']; ?></td>
                        <td><?php echo $carro['modelo']; ?></td>
                        <td><?php echo $carro['placa']; ?></td>
                        <td><?php echo $carro['status']; ?></td>
                        <td>
                            <a href="admin.php?action=excluirCarro&id=<?php echo $carro['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este carro?')">Excluir</a> |
                            <a href="admin.php?action=alterarStatusCarro&id=<?php echo $carro['id']; ?>&status=ativo">Ativar</a> |
                            <a href="admin.php?action=alterarStatusCarro&id=<?php echo $carro['id']; ?>&status=inativo">Inativar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
