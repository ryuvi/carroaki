<?php
$dsn = 'sqlite:cars.db'; // Nome do banco de dados
try {
    $pdo = new PDO($dsn);
    // Definindo erro simples, já que algumas versões do PHP podem não aceitar o modo de exceção diretamente.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // Criação da tabela de carros, se ela não existir
    $sql_carros = "CREATE TABLE IF NOT EXISTS carros (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        modelo TEXT NOT NULL,
        preco REAL NOT NULL,
        ano INTEGER NOT NULL,
        marca TEXT NOT NULL,
        contato TEXT NOT NULL,
        imagem TEXT NOT NULL,
        potencia TEXT,
        combustivel TEXT,
        cambio TEXT,
        quilometragem TEXT
    )";
    $pdo->exec($sql_carros);

    // Criação da tabela de usuarios, se ela não existir
    $sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        role TEXT NOT NULL
    )";
    $pdo->exec($sql_usuarios);

    // Inserir um usuário admin, se não existir
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE username = :username");
    $stmt->execute(array('username' => 'admin'));
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        // Insere o usuário admin
        $stmt = $pdo->prepare("INSERT INTO usuarios (username, password, role) VALUES (:username, :password, :role)");
        // Usando md5 para compatibilidade com PHP 5.3
        $stmt->execute(array( 
            'username' => 'admin',
            'password' => md5('semprelivre'), // senha com md5
            'role' => 'admin'
        ));
    }

    // Inserir alguns carros de exemplo, se a tabela estiver vazia
    $stmt_carros = $pdo->query("SELECT COUNT(*) FROM carros");
    $carros_count = $stmt_carros->fetchColumn();
    
    if ($carros_count == 0) {
        $carros = array(
            array(
                'modelo' => 'Fusca 1974', 
                'preco' => 15000.00, 
                'ano' => 1974,
                'marca' => 'Volkswagen', 
                'endereco' => 'Rua A, 123', 
                'contato' => '(11) 1234-5678',
                'imagem' => 'uploads/fusca.jpg',
                'potencia' => '40 CV',
                'combustivel' => 'Gasolina',
                'cambio' => 'Manual',
                'quilometragem' => '200000 km'
            ),
            array(
                'modelo' => 'Chevrolet Camaro 2022', 
                'preco' => 250000.00, 
                'ano' => 2022,
                'marca' => 'Chevrolet', 
                'contato' => '(11) 9876-5432',
                'imagem' => 'uploads/camaro.jpg',
                'potencia' => '275 CV',
                'combustivel' => 'Gasolina',
                'cambio' => 'Automático',
                'quilometragem' => '5000 km'
            ),
            array(
                'modelo' => 'Honda Civic 2020', 
                'preco' => 90000.00, 
                'ano' => 2020,
                'marca' => 'Honda', 
                'contato' => '(11) 2345-6789',
                'imagem' => 'uploads/honda.jpg',
                'potencia' => '160 CV',
                'combustivel' => 'Gasolina',
                'cambio' => 'CVT',
                'quilometragem' => '30000 km'
            ),
            array(
                'modelo' => 'Palio Fire 2012',
                'preco' => 29000.00,
                'ano' => 2012,
                'marca' => 'Fiat',
                'contato' => '(12) 1234-5678',
                'imagem' => 'uploads/palio.jpg',
                'potencia' => '75 CV',
                'combustivel' => 'Flex',
                'cambio' => 'Manual',
                'quilometragem' => '95000 km'
            )
        );

        foreach ($carros as $carro) {
            $stmt = $pdo->prepare("INSERT INTO carros (modelo, preco, ano, marca, contato, imagem, potencia, combustivel, cambio, quilometragem) 
                               VALUES (:modelo, :preco, :ano, :marca, :contato, :imagem, :potencia, :combustivel, :cambio, :quilometragem)");
            $stmt->bindParam(':modelo', $carro['modelo']);
            $stmt->bindParam(':preco', $carro['preco']);
            $stmt->bindParam(':ano', $carro['ano']);
            $stmt->bindParam(':marca', $carro['marca']);
            $stmt->bindParam(':contato', $carro['contato']);
            $stmt->bindParam(':imagem', $carro['imagem']);
            $stmt->bindParam(':potencia', $carro['potencia']);
            $stmt->bindParam(':combustivel', $carro['combustivel']);
            $stmt->bindParam(':cambio', $carro['cambio']);
            $stmt->bindParam(':quilometragem', $carro['quilometragem']);
            $stmt->execute();
        }
    }

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>