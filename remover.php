<?php
session_start();
include('db.php');

// Verifica se o usuário está logado e é admin
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Verifica se o PDO está definido (evita erros se a conexão falhar)
if (!isset($pdo)) {
    die("Erro na conexão com o banco de dados.");
}

// Se um carro foi selecionado para remoção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carro_id'])) {
    $carro_id = filter_input(INPUT_POST, 'carro_id', FILTER_VALIDATE_INT);

    if ($carro_id) {
        $stmt = $pdo->prepare("DELETE FROM carros WHERE id = :id");
        $stmt->bindParam(':id', $carro_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: remover.php?success=1");
        exit();
    }
}

// Busca todos os carros cadastrados
$stmt = $pdo->query("SELECT id, modelo, marca, preco, ano FROM carros");
$carros = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carro Aki | Remover</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .scroll-box {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background: #fff;
        }

        .carro-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .commands {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .btn {
            width: 48%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Remover Carros</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Carro removido com sucesso!</div>
        <?php endif; ?>

        <form method="POST">
            <div class="scroll-box">
                <?php if (count($carros) > 0): ?>
                    <?php foreach ($carros as $carro): ?>
                        <div class="carro-item">
                            <label>
                                <input type="radio" name="carro_id" value="<?= htmlspecialchars($carro['id']) ?>">
                                <?= htmlspecialchars($carro['marca']) . " " . htmlspecialchars($carro['modelo']) . " (" . htmlspecialchars($carro['ano']) . ") - R$" . number_format($carro['preco'], 2, ',', '.') ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhum carro cadastrado.</p>
                <?php endif; ?>
            </div>

            <div class="commands">
                <button type="submit" class="btn btn-danger">Remover Selecionado</button>
                <a href="index.php" class="btn btn-outline-secondary">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>
