<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #1a1a1a;
            padding: 1rem;
        }

        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }

        .nav-link:hover {
            color: #ff7043 !important;
        }

        .container {
            margin-top: 30px;
            flex-grow: 1;
        }

        .footer {
            background-color: #1a1a1a;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar com link para a página inicial -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">Carro Aki</a>
    </nav>

    <!-- Formulário de Cadastro -->
    <div class="container mb-4">
        <h2 class="mb-4">Cadastro de Veículo</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data" action="../controller/cadastrar_carro.php">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="number" class="form-control" id="ano" name="ano" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="potencia" class="form-label">Potência</label>
                    <input type="text" class="form-control" id="potencia" name="potencia">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="combustivel" class="form-label">Combustível</label>
                    <input type="text" class="form-control" id="combustivel" name="combustivel">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cambio" class="form-label">Câmbio</label>
                    <input type="text" class="form-control" id="cambio" name="cambio">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contato" class="form-label">Contato</label>
                    <input type="text" class="form-control" id="contato" name="contato" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="quilometragem" class="form-label">Quilometragem</label>
                    <input type="text" class="form-control" id="quilometragem" name="quilometragem">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="arquivo" class="form-label">Imagem ou Vídeo</label>
                    <input type="file" class="form-control" id="arquivo" name="arquivo" accept="image/*, video/*" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="/" class="btn btn-outline-secondary">Voltar</a>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Carro Aki. Todos os direitos reservados.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
