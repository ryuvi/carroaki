<?php

require_once 'globals_const.php';

class CarroController {
    public function index() {
        require_once 'models/Carro.php';
        require_once 'src/utils.php';
        $utils = new Utility();
        $carro = new Carro();

        $carros = $carro->listarCarros('', $_SESSION['loja_id']);

        require_once 'views/Dashboards/DashboardCarros.php';
        
    }

    public function exibirCarro() {
        require_once 'models/Carro.php';
        require_once 'src/utils.php';
        $utils = new Utility();
        $carro = new Carro();
        $sCarro = $carro->getCarro($_GET['id']);
        $imagens = explode(',', $sCarro->imagens);

        require_once 'views/carro/CarroIndex.php';
    }

    private function goBack() {
        header('Location: /manage/carro/');
    }

    public function deletarCarro() {
        require_once 'models/Carro.php';
        $carro = new Carro();
        $carro->deletarCarro($_GET['id']);
        $this->goBack();
    }


    public function destacarCarro() {
        require_once 'models/Carro.php';
        $carro = new Carro();
        $carro->destacarCarro($_GET['id']);
        $this->goBack();
    }

    public function inserirCarro() {
        require_once 'models/Carro.php';
        require_once 'src/utils.php';
        $carro = new Carro();
        $utils = new Utility();
        $error = '';
        $success = 'Carro adicionado com sucesso!';

        $pastaDestino = UPLOADS_DIR . '/' . str_replace('\s', '_', trim($_SESSION['loja_nome'])) . '/';
        $caminhoImagens = '';

        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }


        if (!empty($_FILES['imagens']['name'][0])) {
            $caminhosSalvos = array();

            foreach($_FILES['imagens']['name'] as $key => $nomeOriginal) {
                $tmpName = $_FILES['imagens']['tmp_name'][$key];
                $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);

                $novoNome = uniqid().".".$extensao;
                $caminhoCompleto = $pastaDestino.$novoNome;

                if (move_uploaded_file($tmpName, $caminhoCompleto)) {
                    $caminhosSalvos[] = $caminhoCompleto;
                }
            }

            if (!empty($caminhosSalvos)) {
                $caminhoImagens = implode(',', $caminhosSalvos);
            } else {
                $error = "Falha ao salvar os arquivos";
                $success = '';
            }
        } else {
            $error = "Por favor selecione ao menos 1 imagem para o carro!";
            $success = '';
        }

        $car = array(
            "id" => $utils->gerarUUID(),
            "modelo" => $_POST['modelo'],
            "preco" => ((float) str_replace(',','.',str_replace('.', '', $_POST['preco']))),
            "ano" => $_POST['ano'],
            "descricao" => $_POST['descricao'],
            "destaque" => isset($_POST['destaque']) ? 1 : 0,
            "imagens" => $caminhoImagens,
            "loja_id" => $_SESSION['loja_id']
        );

        $message = $carro->inserirCarro($car);
        if ($message !== '') {
            $error = "Erro ao adicionar o carro!\nErro: ".$message;
            $success = '';
        }

        if ($error === '' && $success !== '') {
            $_SESSION['tipo'] = 'success';
            $_SESSION['mensagem'] = $success;
        } else {
            $_SESSION['tipo'] = 'danger';
            $_SESSION['mensagem'] = $error;
        }

        $this->goBack();
    }
}

?>