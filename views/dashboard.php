<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Painel de Administração</h1>

    <!-- Seção de usuários -->
    <section>
        <h2>Gestão de Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['status_pagamento']; ?></td>
                        <td>
                            <!-- Alterar status de pagamento -->
                            <a href="admin.php?action=alterarStatusUsuario&id=<?php echo $usuario['id']; ?>&status=pendente">Bloquear</a> |
                            <a href="admin.php?action=alterarStatusUsuario&id=<?php echo $usuario['id']; ?>&status=ativo">Desbloquear</a> |
                            <a href="admin.php?action=listarCarros&usuario_id=<?php echo $usuario['id']; ?>">Gerenciar Carros</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Seção de lojas -->
    <section>
        <h2>Gestão de Lojas</h2>
        <form action="admin.php?action=criarLoja" method="POST">
            <label for="nome">Nome da Loja:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="cliente_id">Cliente:</label>
            <input type="number" id="cliente_id" name="cliente_id" required>
            <button type="submit">Criar Loja</button>
        </form>
    </section>
</body>
</html>
