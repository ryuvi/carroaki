<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo = $_POST['modelo'];
    $preco = $_POST['preco'];
    $ano = $_POST['ano'];
    $marca = $_POST['marca'];
    $endereco = $_POST['endereco'];
    $contato = $_POST['contato'];
    $potencia = $_POST['potencia'];
    $combustivel = $_POST['combustivel'];
    $cambio = $_POST['cambio'];
    $quilometragem = $_POST['quilometragem'];

    // Lida com o upload do arquivo
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["arquivo"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Verifica se o arquivo é uma imagem ou vídeo permitido
    if (in_array($fileType, array('jpg', 'png', 'jpeg', 'gif', 'mp4', 'avi', 'mov'))) {
        if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
            // Insere o carro com todos os novos dados
            $stmt = $pdo->prepare("INSERT INTO carros (modelo, preco, ano, marca, contato, imagem, potencia, combustivel, cambio, quilometragem) 
                                   VALUES (:modelo, :preco, :ano, :marca, :contato, :imagem, :potencia, :combustivel, :cambio, :quilometragem)");
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':ano', $ano);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':contato', $contato);
            $stmt->bindParam(':imagem', $target_file);
            $stmt->bindParam(':potencia', $potencia);
            $stmt->bindParam(':combustivel', $combustivel);
            $stmt->bindParam(':cambio', $cambio);
            $stmt->bindParam(':quilometragem', $quilometragem);
            $stmt->execute();
            echo "<div class='alert alert-success' role='alert'>Carro cadastrado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao fazer o upload do arquivo.</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Somente arquivos de imagem (jpg, png, gif) ou vídeo (mp4, avi) são permitidos.</div>";
    }
}
?>

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
        <form method="POST" enctype="multipart/form-data">
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
